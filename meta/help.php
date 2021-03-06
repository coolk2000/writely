<html lang="en">
	<head>
		<title>writely; help</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/modules/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<link href="/css/footer.css" rel="stylesheet">
		<link href="/css/index.css" rel="stylesheet">
		<link href="/css/user.css" rel="stylesheet">
    <link href="/css/help.css" rel="stylesheet">
		<script src="/modules/jquery/jquery-2.1.3.min.js"></script> 
    <script src="/js/isotope.min.js"></script> 
    <script src="/js/helpsidebar.js"></script> 
	</head>
	<body>

		<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <a class="navbar-brand" href="#">writely</a>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/index"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home</a></li>
            <li><a href="/meta/"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbsp;Meta</a></li>
            <li class="active"><a href="#"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>&nbsp;Help</a></li>
          </ul>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<div class="container">

      <h1 style="display:inline">Help</h1> <h4 style="display:inline"><a id="header" href="#header">#</a></h4>
      <hr style="margin-bottom:20px" />
      <h2 style="display:inline">Prefix</h2> <h4 style="display:inline"><a id="prefix" href="#prefix">#</a></h4>
      <br />
      <br />
      <p>Hello there! Welcome to the humble "help" page. <br /><br /> Get ready, as this page is going to rock your world by sending you on a journey through the site's entire documentation from start to finish. Unless, of course, you decide to just use that handy-dandy thing in the corner that lets you magically leap through the documentation using the power of links. Enough exaggeration and rambling, let's get on with the documentation for writely.</p>
      <hr />
      <h2 style="display:inline">Backstory</h2> <h4 style="display:inline"><a id="backstory" href="#backstory">#</a></h4>
      <br />
      <br />
      <p>Writely is a project that spanned at least a week, and I (Jake) wrote the whole thing (with the help of a bunch of code snippets, I'm a novice programmer). At the time of writing this (2/15/2015), the code is nearly production-ready. If you don't know what that means, here's a translation: "this website is almost ready to be used by the average Internet-goer."</p>
      <hr />
      <h2 style="display:inline">Markdown</h2> <h4 style="display:inline"><a id="markdown" href="#markdown">#</a></h4>
      <br />
      <br />
      <p>This part of the page is linked to by the footer at the bottom of every page. If you clicked that link.. Hi!<br /><br />Markdown is a formatting system that's really quite simple. It makes writing pages a whole lot easier, and you'll find out why if you keep reading.<br /><br /></p>
      <h3 style="display:inline">The Basics</h3> <h4 style="display:inline"><a id="markdown-basics" href="#markdown-basics">#</a></h4>
      <br />
      <br />
      <p>First and foremost, Markdown doesn't format plain text. That means if you were to write something like</p>
      <pre>The quick brown fox jumps over the lazy dog.</pre>
      <p>it would still pop back out the same</p>
      <pre>The quick brown fox jumps over the lazy dog.</pre>
      <p>Then, it gets a little less simple (and few people, if not, nobody, find this annoying). If you were to type in</p>
      <pre>The quick brown fox<br />jumps over the lazy dog.</pre>
      <p>That would still pop out as</p>
      <pre>The quick brown fox jumps over the lazy dog.</pre>
      <p>So, to combat this, you simply double-press <kbd>Enter</kbd> instead of single-press it, and Markdown will then happily spit it out as</p>
      <pre>The quick brown fox<br />jumps over the lazy dog.</pre>
      <br />
      <h3 style="display:inline">Italics, Boldness, and Stuff</h3> <h4 style="display:inline"><a id="markdown-part2" href="#markdown-part2">#</a></h4>
      <br />
      <br />
      <p>You'll also notice that there's no toolbar at the top of the text editor when you're editing a page. This is because Markdown will automatically do the stuff that those toolbars do, for you. For example,</p>
      <pre>*The quick brown fox*<br />_jumps over the lazy dog._</pre>
      <p>If you encase your text in _underscores_ or *asterisks*, Markdown will take it as italicizing, like so:</p>
      <pre><i>The quick brown fox</i><br /><i>jumps over the lazy dog.</i></pre>
      <p>To make text <b>bold</b>, you'd add two **asterisks** to either side. If you want to both <b><i>italicize and bold</i></b> something, add ***three***. It's as simple as that. If you want to put a strikethrough, or <s>"cross out"</s> something, you just put two ~~tilde~~ around your text.</p>
      <br />
      <h3 style="display:inline">Links & Blockquotes</h3> <h4 style="display:inline"><a id="markdown-part3" href="#markdown-part3">#</a></h4>
      <br />
      <br />
      <p>If you want to make a link, it's simple, Markdown automatically makes links with a preceeding <kbd>http://</kbd> clickable. If you wanted to make a piece of text link to something, that's easy too. Just do this:</p>
      <pre>[The text you want to have the link on](http://what-you-want-the-text-to-link-to.com)</pre>
      <p>Blockquotes. These are little pieces of text that would quote something that someone else said. Like so:</p>
      <blockquote>This is a quote.<br />It can span multiple lines.</blockquote>
      <p>It's easy to do these too, just put a <kbd>></kbd> in front of the text. If you want the quote to cut off, just put two linebreaks (press your <kbd>Enter</kbd> key twice) and it'll continue as normal text.</p>
      <br />
      <h3 style="display:inline">Headers & Horizontal Rules</h3> <h4 style="display:inline"><a id="markdown-part4" href="#markdown-part4">#</a></h4>
      <br />
      <br />
      <p>You should know what a header is. Here's how you make them:</p>
      <pre># This is the biggest header you can make<br />## This is the second biggest header you can make<br />### This is the third,<br />#### Fourth..<br />##### Fifth, oh boy, almost done<br />###### And finally, the sixth. Which is kinda like a smaller version of normal-sized text. Wow.</pre>
      <p>And a horizontal rule is basically a straight horizontal line that spans the whole length of the page (horizontally, not vertically).</p>
      <pre>---<br />That'll make a horizontal rule<br /><br />***<br />So will that.</pre>
      <br />
      <h3 style="display:inline">Lists & Code</h3> <h4 style="display:inline"><a id="markdown-part5" href="#markdown-part5">#</a></h4>
      <br />
      <br />
      <p>(Almost) Finally, here's how you make lists:</p>
      <pre>1. This will make<br />2. An ordered, numbered list.<br />1. Even if you were to<br />7. make the numbers out of order</pre>
      <p>That will output</p>
      <pre><ul>1. This will make<br />2. An unordered, numbered list.<br />3. Even if you were to<br />4. make the numbers out of order</ul></pre>
      <p>If you want an unordered (bullet) list, just put <kbd>-</kbd> (dashes) in front of each list item.<br /><br />(Really) Finally, here's how you geek out and make code:</p>
      <pre>Just put four spaces before the block of code, and it will magically become code. This is an example of it, actually. This surrounding box!</pre>
      <br />
      <h3 style="display:inline">The End</h3> <h4 style="display:inline"><a id="markdown-part6" href="#markdown-part6">#</a></h4>
      <br />
      <br />
      <p>Hooray, I finally finished writing a guide on how to use Markdown! Woohoo!</p>

		</div>
		<footer class="footer">
			<div class="container">
				<div class="text-muted">
					<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
					2015 Jake Koenen | <script type="text/javascript" src="../modules/footquote/random.php?type=1"></script>
				</div>
			</div>
		</footer>
		<script src="/modules/jquery/jquery-2.1.3.min.js"></script>
    	<script src="/modules/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>