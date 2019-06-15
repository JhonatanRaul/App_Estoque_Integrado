'use strict'

const mysql = require('mysql'),
	conf = require('./DbConf'),
    DbOptions = {
		host: conf.mysql.host,
		port: conf.mysql.port,
		user: conf.mysql.user,
		password: conf.mysql.pass,
		database: conf.mysql.db
	},
	StockModel = () => {}

StockModel.getMaximumCost = (_idMaterial, cb) => {
    let conn = mysql.createConnection(DbOptions)
	conn.connect((err) => {
		if (err)
			return (err)
	})
	conn.query('SELECT MAXIMUM_COST FROM MATERIAL_STANDARDS WHERE ID_MATERIAL = ?', _idMaterial, cb)
	conn.end((err) => {
		if (err)
			return (err)
	})
}

StockModel.savePurchase = (material, cb) => {
	let conn = mysql.createConnection(DbOptions)
	conn.connect((err) => {
		if (err)
			return (err)
	})
	conn.query('INSERT INTO PURCHASED (ID_MATERIAL, ID_SUPPLIER, UNIT_COST, QUANTITY, PURCHASE_DATE) VALUES (?, ?, ?, ?, ?)', [material._idMaterial, material._idSupplier, material._unitCost, material.quantity, material._purchaseDate], cb)
	conn.end((err) => {
		if (err)
			return (err)
	})
}

module.exports = StockModel