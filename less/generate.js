var fs = require('fs');
var path = require("path");
var less = require('less');

var paths = [__dirname];
paths.push(path.join(__dirname,"..","dev-time"));

function generateCss(from_dir,to_dir,filename) {
	
	var basic_less = fs.readFileSync(path.join(from_dir,filename),"utf8");
	var basic_out = path.join(to_dir,filename);

	var parser = new less.Parser({
	    paths: paths, // Specify search paths for @import directives
	    filename: filename // Specify a filename, for better error messages
	});

	parser.parse(basic_less, function (e, tree) {
	    var css = tree.toCSS({ compress: true }); // Minify CSS output
		fs.writeFile(basic_out , css, function(err){
		});
	});
}

generateCss(__dirname, path.join(__dirname,"..","css"), "thirds.less");
generateCss(__dirname, path.join(__dirname,"..","css"), "fourths.less");
generateCss(__dirname, path.join(__dirname,"..","css"), "twothirds.less");
