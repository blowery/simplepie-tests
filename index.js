var express = require("express"),
    _ = require("lodash");

var app = express();

app.get("/single/", function(req, res) {
	res.sendfile("./single.html");
});

app.get("/multiple/", function(req, res) {
	res.sendfile("./multiple.html");
});

app.get("/", function(req, res) {
	res.sendfile("./index.html");
});

app.get("/feed/", function(req, res) {
	res.type("application/rss+xml").sendfile( "./feed.xml" );
});

app.get("/feed-two/", function(req, res) {
	res.type("application/rss+xml").sendfile( "./feed.xml" );
});

app.get("/redirect/:how/", function(req, res) {
	res.redirect(+req.params.how, req.query.href);
});

app.get("/chain-temp/:id/", function(req, res) {
	var id = +req.params.id;
	if(isNaN(id)) {
		res.send(500, "Invalid id");
		return;
	}

	// limit to positive numbers
	id = Math.max(0, id);

	if(id === 0) {
		res.redirect(302, "/feed/");
		return;
	}

	res.redirect(302, "/chain-temp/" + (id - 1) + "/" );
});

app.get("/chain-perm/:id/", function(req, res) {
	var id = +req.params.id;
	if(isNaN(id)) {
		res.send(500, "Invalid id");
		return;
	}

	// limit to positive numbers
	id = Math.max(0, id);

	if(id === 0) {
		res.redirect(301, "/feed/");
		return;
	}

	res.redirect(301, "/chain-perm/" + (id - 1) + "/" );
});

app.get("/chain-mixed/:id/", function(req, res) {
	var id = +req.params.id;
	if(isNaN(id)) {
		res.send(500, "Invalid id");
		return;
	}

	// limit to positive numbers
	id = Math.max(0, id);

	if(id === 0) {
		res.redirect(301, "/feed/");
		return;
	}

	res.redirect(id % 2 ? 302 : 301, "/chain-mixed/" + (id - 1) + "/" );
});

app.listen(9998);