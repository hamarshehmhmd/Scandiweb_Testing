const { execFile } = require('child_process');
const path = require('path');

exports.handler = (event, context, callback) => {
  const phpFilePath = path.join(__dirname, '../../public', event.path);

  console.log(`Handling request for: ${phpFilePath}`);

  execFile('php-cgi', ['-f', phpFilePath], (error, stdout, stderr) => {
    if (error) {
      console.error(`Error executing PHP file: ${stderr}`);
      callback(null, {
        statusCode: 500,
        body: `Error executing PHP file: ${stderr}`,
      });
      return;
    }

    console.log(`PHP file executed successfully: ${stdout}`);

    callback(null, {
      statusCode: 200,
      body: stdout,
      headers: {
        'Content-Type': 'text/html',
      },
    });
  });
};
