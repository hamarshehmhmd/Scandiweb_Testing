const express = require('express');
const { execFile } = require('child_process');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 3000;

app.use(express.static('public'));

// Serve PHP files
app.get('/*.php', (req, res) => {
  const phpFilePath = path.join(__dirname, 'public', req.path);
  
  execFile('php-cgi', ['-f', phpFilePath], (error, stdout, stderr) => {
    if (error) {
      res.status(500).send(stderr);
      return;
    }
    res.send(stdout);
  });
});

app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
