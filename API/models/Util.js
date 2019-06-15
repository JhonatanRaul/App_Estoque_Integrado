'use strict'

const Util = () => {}

Util.DbErrors = (err, locals, res) => {
    if (err.errno == 'ECONNREFUSED') {
        locals.description = "503 - Connection to database failed."
        res.status(503).send(locals)
    } else if (err.errno == 1045) {
        locals.description = "503 - Connection to the unauthorized database."
        res.status(503).send(locals)
    } else {
        locals.description = "500 - Without description."
        res.status(500).send(locals)
    }
}

module.exports = Util