var cors = require('cors');
var express = require('express')
var app = express()

app.use(cors());
app.options('*', cors());

app.set('port', (process.env.PORT || 3000))
app.use(express.static(__dirname + '/public'))


app.get('/', function(request, response) {
  response.send('Hello Dlike!')
})

app.listen(app.get('port'), function() {
  console.log("Node app is running at localhost:" + app.get('port'))
})