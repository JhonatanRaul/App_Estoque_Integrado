'use strict'

const StockModel = require('../models/StockModel'),
      ModelUtil = require('../models/Util'),
      validator = require('validator'),
      StockController = () => {}

StockController.newMaterial = (req, res) => {

	let material = {
		_idMaterial: req.body._idMaterial,
		_idSupplier: req.body._idSupplier,
		_unitCost: req.body._unitCost,
        quantity: req.body.quantity,
        _purchaseDate: req.body._purchaseDate
	}
    
    // Validar informações
    req.checkBody('_idMaterial', 'Material Id can not be empty.').notEmpty()
    req.checkBody('_idMaterial', 'Material Id be between 1 and 10 characters.').len(1, 10);
    req.checkBody('_idSupplier', 'Supplier Id can not be empty.').notEmpty()
    req.checkBody('_idSupplier', 'Supplier Id be between 1 and 10 characters.').len(1, 10);
    req.checkBody('_unitCost', 'Unit cost can not be empty.').notEmpty()
    req.checkBody('_unitCost', 'Unit cost should be currency value. Pattern: 0.00').matches(/^\d+(?:\.\d{0,2})$/, "i")
    req.checkBody('_unitCost', 'Unit cost be between 1 and 19 characters.').len(1, 22)
    req.checkBody('quantity', 'Quantity can not be empty.').notEmpty()
    req.checkBody('quantity', 'Quantity must be between 1 and 10 characters.').len(1, 10)
    req.checkBody('_purchaseDate', 'Purchase date can not be empty.').notEmpty()
    
    
    const errors = req.validationErrors()
    var errDate = false;
    var dataErr = {};
    
    if(material._purchaseDate != undefined){
        if(!validator.matches(material._purchaseDate, /^(((\d{4})(-)(0[13578]|10|12)(-)(0[1-9]|[12][0-9]|3[01]))|((\d{4})(-)(0[469]|11)(-)(0[1-9]|[12][0-9]|30))|((\d{4})(-)(02)(-)(0[1-9]|[12][0-9]|2[0-8]))|(([02468][048]00)(-)(02)(-)(29))|(([13579][26]00)(-)(02)(-)(29))|(([0-9][0-9][0][48])(-)(02)(-)(29))|(([0-9][0-9][2468][048])(-)(02)(-)(29))|(([0-9][0-9][13579][26])(-)(02)(-)(29)))(\s)(([0-1][0-9]|2[0-4]):([0-5][0-9]):([0-5][0-9]))$/)){
            dataErr = {
                "location": "body",
                "param": "_purchaseDate",
                "msg": "Purchase date must be a date by default: YYYY-MM-DD HH:MM:SS"
            }
            
            if(!errors){
                errDate = []
                errDate.push(dataErr)
            } else {
                errors.push(dataErr)
            }
        }
    }
    
    if (errors || errDate) {
        if(!errors){
            let locals = {
                error: 'Validation error',
                description: errDate
            }

            res.status(400).send(locals)
        } else {
            if(errDate)
                errors.push(dataErr)
            
            let locals = {
                error: 'Validation error',
                description: errors
            }

            res.status(400).send(locals)
        }
    } else {
        // Verificar se o material esta cadastrado e se o custo máximo é <= ao custo unitário
        StockModel.getMaximumCost(material._idMaterial, (err, rows) => {
			if (err) {
				let locals = {
					error: "Error fetching material"
				}
                
                ModelUtil.DbErrors(err, locals, res)
			} else {
				let locals = {}
                
                if(rows == ''){
                    locals.error = 'Material not found'
                    locals.description = "400 - Without description."
                    res.status(400).send(locals)
                } else {
                    // Verificar se custo unitário é <= ao custo máximo
                    if(material._unitCost <= rows[0].MAXIMUM_COST){
                        StockModel.savePurchase(material, (err, cb) => {
                            if (err) {
                                if(err.errno == 1452){
                                    locals.error = 'Supplier not found.'
                                    locals.description = "400 - Without description."
                                    res.status(400).send(locals)
                                } else {                                
                                    locals.error = 'Could not register purchase.'
                                    locals.description = "500 - Without description."
                                    res.status(500).send(locals)
                                }
                            } else {
                                locals.title = '201 - Purchase registered'
                                locals.details = cb
                                res.status(201).send(locals)
                            }
                        })
                    } else {
                        locals.error = 'Could not register purchase.'
                        locals.description = "400 - Unit cost of the material can not be greater than the registered maximum cost."
                        res.status(400).send(locals)
                    }
                }
			}
		})  
    }
}

module.exports = StockController