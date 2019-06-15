'use strict'

const app = require('./app'),
	server = app.listen(app.get('port'), () => {
		console.log(`Server started: http://localhost:${app.get('port')}`)
	})