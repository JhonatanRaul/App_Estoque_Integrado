'use strict'

const express = require('express'),
      router = express.Router(),
      StockController = require('../controllers/StockController')

router
    .post('/material', StockController.newMaterial)

module.exports = router