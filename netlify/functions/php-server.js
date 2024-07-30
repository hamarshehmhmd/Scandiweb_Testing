const { execFile } = require('child_process');
const path = require('path');

exports.handler = (event, context, callback) => {
  const phpFilePath = path.join(__dirname, '../../public', event.path);

  execFile('php-cgi', ['-f', phpFilePath], (error, stdout, stderr) => {
    if (error) {
      callback(null, {
        statusCode: 500,
        body: stderr,
      });
      return;
    }

    callback(null, {
      statusCode: 200,
      body: stdout,
      headers: {
        'Content-Type': 'text/html',
      },
    });
  });
};
