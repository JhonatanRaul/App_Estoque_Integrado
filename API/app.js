const bodyParser = require('body-parser'),
      express = require('express'),
	  expressValidator = require('express-validator'),
      port = (process.env.PORT || 3000),
      routes = require('./routes/StockRouter'),
	  app = express()

app
	.set('port', port)
    // parse application/json
	.use(bodyParser.json())
	// parse application/x-www-form-urlencoded
	.use(bodyParser.urlencoded({
		extended: false
	}))
    .use(expressValidator())
    .use(routes);

module.exports = app