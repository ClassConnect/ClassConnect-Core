<?php
session_start();
require_once('../inc/site/serverConfig.php');
if (isset($_SESSION['user_id'])) {
	require_once('../inc/user/var_set.php');
	$color = $theme['settingColor'];
} else {
    require_once('../inc/coreInc.php');
    $themeData =  getVanityScheme();
    $color = $themeData['settingColor'];
}
header('Content-type: text/css');

echo "/* top elements */
* { margin: 0;	padding: 0; }

body {
	margin: 0; padding: 0;
	font: 70%/1.5 Arial, Helvetica, sans-serif;
	color: #333; 
	background: #FFF;
}

/* links */
a {
	color: #003366;
	background-color: inherit;
	text-decoration: none;
}
a:hover {
	color: " . $color . "; 
	background-color: inherit;
}

/* headers */
h1, h2, h3 {
	font-weight: bold;
	color: #333;
}
h1 {
	font-size: 120%;
	letter-spacing: .5px;
}
h2 {
	font-size: 115%;	
	text-transform: uppercase; 		
}
h3 {
	font-size: 115%;
	color: #003366;		
}

/* images */
img {
}
img.float-right {
  margin: 5px 0px 10px 10px;  
}
img.float-left {
  margin: 5px 10px 10px 0px;
}
img.hud {
  padding-top: 0;
}

h1, h2, p {
	padding: 0;		
	margin: 10px;
}

ul, ol {
	margin: 10px 20px;
	padding: 0 20px;
}

code {
  margin: 10px 0;
  padding: 10px;
  text-align: left;
  display: block;
  overflow: auto;  
  font: 500 1em/1.5em 'Lucida Console', 'courier new', monospace;
  /* white-space: pre; */
  background: #FAFAFA;
  border: 1px solid #f2f2f2;  
  border-left: 4px solid #CC0000;
}
acronym {
  cursor: help;
  border-bottom: 1px solid #777;
}
blockquote {
	margin: 10px;
 	padding: 0 0 0 32px;  	
  	background: #FAFAFA;
	background-position: 8px 10px;
	border: 1px solid #f2f2f2; 
	border-left: 4px solid #CC0000; 
	font-weight: bold;  
}

/* form elements */
form {
}
input {
	border: 1px solid #999;
	font-size:14px;
	padding-top:3px;
	padding-bottom:3px;
	padding-left:3px;
	
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}
textarea {
	border: 1px solid #999;
	font-size:14px;
	padding-top:3px;
	padding-bottom:3px;
	padding-left:3px;
	
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}
.comment {
	float:left;
	background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
	font-size:16px;
	width:70px;
	height: 34px;
	border: 1px solid #999999;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 0px;
	-khtml-border-radius-bottomleft: 0px;
	-webkit-border-bottom-left-radius: 0px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 0px;
	-khtml-border-radius-topleft: 0px;
	-webkit-border-top-left-radius: 0px;
	outline: none;
}
input.commentwall {
	float:left;
	width:653px;
	font-size:16px;
	padding-top:6px;
	padding-bottom:6px;
	border: 1px solid #999999;
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomright: 0px;
	-khtml-border-radius-bottomright: 0px;
	-webkit-border-bottom-right-radius: 0px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topright: 0px;
	-khtml-border-radius-topright: 0px;
	-webkit-border-top-right-radius: 0px;
	outline: none;
}

/**********************************
  LAYOUT 
***********************************/
#wrap {
	margin: 0 auto; 
	width: 900px;
}

/* header */
#header {

	margin: 0; padding: 0;
	height: 40px;
	width: 900px;
	border-bottom: 1px solid #9d9d9d;
	border-left: 1px solid #9d9d9d;
	border-right: 1px solid #9d9d9d;
	background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
	margin-bottom:20px;
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
}
ul.topnav {  
margin: 0;
padding: 0;
padding-left: 0; /*offset of tabs relative to browser left edge*/
font-size:14px;
list-style: none; 
width: 900px; 
}  
ul.topnav li { 
float: left;
display: inline;
margin: 0;
position: relative; /*--Declare X and Y axis base for sub navigation--*/  
z-index: 9995;
}  
ul.topnav li a{  
float: left;
display: block;
text-decoration: none;
padding: 9px 10px; /*padding inside each tab*/
border-right: 1px solid #aaa; /*right divider between tabs*/
color:#000;
}  
ul.topnav li a:hover{  
    background: url(" . $imgServer . "header/bkg_hov.png) repeat-x center top;

}
ul.topnav li div a.hoverhack{
	background: url(" . $imgServer . "header/bkg_hov.png) repeat-x center top; 
	
}
ul.topnav li.logo {
padding-top:0;
padding-right:5px;
padding-bottom:0;
padding-left:3px;
border:none;
}
ul.topnav li.logo a{

}
ul.topnav li a:visited{
color:#000;
}
ul.topnav li div { /*--Drop down trigger styles--*/  
    width: 100%;
	height: 100%;
}  
ul.topnav li div ul.subnav {  
    list-style: none;  
    position: absolute; /*--Important - Keeps subnav from affecting main navigation flow--*/  
    left: 0; top: 40px;
    background: #eaeae0;
    margin: 0; padding: 0;  
    display: none;  
    float: left;  
	border-right: 1px solid #aaa;
	border-left: 1px solid #aaa;
	border-bottom: 1px solid #aaa;
/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
 
}  
ul.topnav li ul.subnav li{  
    margin: 0; padding: 0;   
    clear: both;  
    width: 190px;  
	border-bottom: 1px solid #aaa;
}  
html ul.topnav li ul.subnav li a {  
    float: left;  
    width: 170px;  
    padding-left: 10px;  
}  
html ul.topnav li ul.subnav li a:hover { /*--Hover effect for subnav links--*/  
    background: " . $color . ";
	color: #FFF;
} 

/* main column */
#main {
	
	font-size: 12px;
	margin: 5px 0 0 0; padding: 0;
	width: 496px;	
	float:left;
	border: 2px solid #aaa;
	background: #FFF;
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}
#main .entry{
	padding-left: 5px;
	padding-top: 5px;
	padding-bottom:5px;
	border-bottom: 1px solid #aaa;
}
#main h1 {
	margin: 0 0;
	
	padding: 0 0 0 5px;
	font-size: 14px;
	border-bottom: 1px solid #770000;
	color: #fff;
	background: " . $color . ";
	letter-spacing: 0px;
}
#leftbar {
	float: left;
	width: 200px;
	margin: 0; padding: 0; 
	background-color: #FFFFFF; 	
	
	font-size: 11px;
}
#leftbar h1 {
	margin: 0 0 5px 0;
	
	padding: 0 0 4px 5px;
	height: 15px;
	font-size: 14px;
	color: #000000;	
	border-bottom: 1px solid #CCCCCC;
	letter-spacing:0;
}
#leftbar p {
	margin: 0;
	padding-left: 5px;
	padding-top:3px;
	padding-bottom:3px;
}
#leftbar .date {
	color: #999;
	margin: 0;
	padding-left: 5px;
	padding-top:3px;
	padding-bottom:0;
	border-bottom: 1px solid #aaa;
}

#leftbar .dp {
	font-size:9px;
	color:#aaa;
	float:right;
}

/* sidebar */
#sidebar {
	float: right;
	width: 200px;
	margin: 0; padding: 0; 
	background-color: #FFFFFF; 	
	
	font-size: 11px;
}
#sidebar h1 {
	margin: 0 0;
	
	padding: 0 0 4px 10px;
	height: 15px;
	font-size: 14px;
	color: #000000;	
	border-bottom: 1px solid #CCCCCC;
	letter-spacing:0;
}
#sidebar p {
	margin: 0;
	padding-left: 10px;
	padding-top:3px;
	padding-bottom:3px;
	border-bottom: 1px solid #aaa;
}
#sidebar p:hover{
	background: #e1e1e1;
}

#sidebar .dp {
	font-size:9px;
	color:#999;
	float:right;
}

/* main column */
#main_wrap {
	width:750px;
	float:right;
}
#class_main {
	
	font-size: 12px;
	float: right;
	margin: 0 0 0 0; padding: 0;
	width: 751px;
	background: #FFF;
}
#class_main .info {
	border: 1px solid #aaa;
		/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}
#class_main .listView {

}
#class_main .forum_head {
	font-size:16px;
	font-weight:bolder;
}
#class_main .forum_peek {
	color:#666;
	padding-bottom:5px;
}
#class_main .forum_foot {
	clear:left;
	border-bottom: 1px solid #ccc;
}
#class_main .forum_peek {
	color:#999;
}
#class_main .forum_load {
	color: #333;
	background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
	list-style:none;
		height:40px;
		border-bottom: 1px solid #aaa;
}
#class_main .load_text {
	color: #333;
	font-size:16px;
	padding-top:8px;
}
#class_main .forum_load:hover {
	background: #CCC url(" . $imgServer . "header/bkg_hov.png) repeat-x;

}
#class_main .comment_load {
	color: #333;
	background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
	list-style:none;
		height:40px;
		-moz-border-radius: 5px;
	-khtml-border-radius: 5px;
	-webkit-border-radius: 5px;
	border: 1px solid #999;
}
#class_main .comment_load_text {
	color: #333;
	font-size:16px;
	padding-top:8px;
	text-align:center;
}
#class_main .comment_load:hover {
	background: #CCC url(" . $imgServer . "header/bkg_hov.png) repeat-x;

}

#class_main h1 {
	margin: 0 0;
	
	padding: 0 0 0 5px;
	font-size: 14px;
	border: 2px solid #770000;
	color: #fff;
	background: " . $color . ";
	letter-spacing: 0px;
		/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}
#class_comments {
	clear:both;
	font-size: 12px;
	float: right;
	margin: 5px 0 0 0; padding: 0;	
	background: #FFF;
                   margin-left: 10px;
}
#navcrumbs {
	font-size: 23px;
	color:#666666;
	margin-bottom: 5px;
	padding:0;
	overflow:hidden;
}
/* sidebar */
#class_sidebar {
	float: left;
	width: 148px;
        height:580px;
	margin-top: 7px; padding: 0; 	
	font-size: 12px;
        border-right: 1px solid #ededec;
}
#class_sidebar h1 {
	margin: 0 0;
	padding: 0 0 4px 10px;
	height: 15px;
	font-size: 14px;
	color: #000000;	
	border-bottom: 1px solid #aaa;
	letter-spacing:0;
}
#class_sidebar li {
	list-style:none;
	margin: 0;
	padding-left: 3px;
	margin-top:3px;
	margin-bottom:3px;
	color: #666;
}
#class_sidebar li a{
color: #666;
}
#class_sidebar li.active_item {
	color: " . $color . ";
	font-weight: bolder;
                   border-left: 4px solid " . $color . ";
}
#class_sidebar li.active_item a{
	color: " . $color . ";

}
#class_sidebar li:hover{
	color: #000000;
}

#class_sidebar .dp {
	font-size:9px;
	color:#999;
	float:right;
}


#teach_menu {
border-bottom: 1px solid #f3f3f3;
margin-bottom: 15px;
}

#teach_menu .item {
color: #909090;
margin-left:10px;
padding-left:8px;
padding-right:8px;
padding-top:3px;
}

#teach_menu .item a{
color: #909090;
}

#teach_menu .item:hover {
background: #f5f5f2;
border-bottom: 3px solid " . $color . ";
}

/* posting main */
#pmain {
	
	font-size: 12px;
	float: right;
	margin: 0 0 20px 0; padding: 0;
	width: 665px;	
	background: #FFF url(images/post/main_bk.png) repeat center top;
}
#pmain h1 {
	margin: 0 0;
	
	padding: 8px 0 0 15px;
	height: 39px;
	font-size: 14px;
	color: #000000;
	background: url(images/post/h1.png) no-repeat center top;
	letter-spacing: 0px;
}
#pmain .info-box {
	
}
#pmain .end-box {
	
	height: 14px;
	background: url(images/post/main_bot.png) no-repeat center bottom;
}
/* post sidebar */
#pside {
	float: left;
	width: 225px;
	margin: 0; padding: 0; 
	background-color: #FFFFFF; 	
	
	font-size: 12px;
}
#pside .swrap {
	margin: 0 0 0 0;
	background: #FFF url(images/post/side_bk.png) repeat center top;
}
#pside h1 {
	margin: 5px 0;
	
	padding: 2px 0 6px 10px;
	height: 15px;
	font-size: 14px;
	color: #000000;
	background: url(images/post/sh1.png) no-repeat center top;
	letter-spacing: 0px;	
	border-bottom: 1px solid #CCCCCC;
}
#pside .left-box {
	
}
#pside .end-box {
	height: 8px;
	background: url(images/post/side_bot.png) no-repeat center bottom;
}
/* main on right */
#mainr {
	
	font-size: 12px;
	float: right;
	margin: 0 0 20px 0; padding: 0;
	width: 605px;	
	background: #FFF url(images/mi_rep.png) repeat center top;
}
#mainr h1 {
	margin: 0 0;
	
	padding: 8px 0 0 15px;
	height: 34px;
	font-size: 14px;
	color: #000000;
	background: url(images/main_top.png) no-repeat center top;
	letter-spacing: 0px;
}
#mainr .info-box {
	
}
#mainr .end-box {
	
	height: 8px;
	background: url(images/mi_bot.png) no-repeat center bottom;
}
/* middle column */
#midcol {
	
	font-size: 12px;
	float: none;
	margin: 50px 0 20px 250px;
	width: 415px;	
	background: #FFF url(images/bak1.jpg) repeat center top;
}
#midcol h1 {
	margin: 0 0;
	
	padding: 6px 0 0 10px;
	height: 34px;
	font-size: 14px;
	color: #000000;
	background: url(images/bartop.jpg) no-repeat center top;
	letter-spacing: 0px;
}
#midcol .info-box {
	
}
#midcol .end-box {
	
	height: 8px;
	background: url(images/barbottom.jpg) no-repeat center bottom;
}

/* main filedir column */
#filedir {
	
	font-size: 12px;
	float: right;
	margin: 0 0 20px 0; padding: 0;
	width: 736px;	
	background: #FFF url(images/t5/file_rep.png) repeat center top;
}
#filedir h1 {
	margin: 0 0;
	
	padding: 5px 0 0 10px;
	height: 33px;
	font-size: 14px;
	color: #000000;
	background: url(images/t5/file_top.png) no-repeat center top;
	letter-spacing: 0px;
}
#filedir .end-box {
	
	height: 20px;
	background: url(images/t5/file_bot.png) no-repeat center bottom;
}
/* file sidebar */
#fileside {
	float: left;
	width: 140px;
	margin: 0;
	padding-left: 24px;
	padding-top: 7px;
	background-color: #FFFFFF; 	
	
	font-size: 12px;
}
#fileside .swrap {
	margin: 0 0 0 0;
	background: #FFF url(images/t5/fside_rep.png) repeat center top;
}
#fileside h1 {
	margin: 5px 0;
	
	padding: 0 0 0 10px;
	height: 2px;
	font-size: 2px;
	color: #000000;
	background: url(images/t5/fside_top.png) no-repeat center top;
}
#fileside .end-box {
	height: 8px;
	background: url(images/t5/fside_bot.png) no-repeat center bottom;
}
#barline {
border-bottom: 1px solid #CCCCCC;
}

/* footer */
.ccfooter {
margin-top:20px;
	clear: both;
	border-top: 2px solid #f2f2f2;
	border-bottom: 2px solid #f2f2f2;
	padding: 0 0 0 0;
	text-align: center;
	line-height: 1.5em;
	font-size: 95%;
	background-color: #F5F5F5;
}
.ccfooter a { 
	text-decoration: none; 
	font-weight: bold;		
}



/* alignment classes */
.float-left  { float: left; }
.float-right { float: right; }
.align-left  { text-align: left; }
.align-right { text-align: right; }

/* display and additional classes  */
.clear {	clear: both; }
.red   { color: #CC0000; }
.green { color: #33FF00; }
.gt {
	color: #797979;
	font-size: 12px;
	
}
.gt a {
	color: #797979;
	background-color: inherit;
	text-decoration: underline
}
.smalltext {
	color: #797979;
	font-size: 10px;
	
}
.calhead {
	color: #000000;
	font-size: 25px;
	
}
.classes {
	color: #000000;
	font-size: 13px;
	
}

.comments { 
	margin: 20px 10px 5px 10px; 
	padding: 3px 0;
	border-bottom: 1px dashed #EFF0F1; 	
	border-top: 1px dashed #EFF0F1;	
}
.perror {
	color: #000000;
	font-size: 24px;
	
}
.msg {
	color: #000000;
	font-size: 15px;
	
}


/* Calendar CSS Styling */
table.calendar {

}
table.calendar td { 
vertical-align: top;
width: 130px;
height:100px;
}


#footpanel {
	position: fixed;
	bottom: 0; left: 0;
	z-index: 9997; /*--Keeps the panel on top of all other elements--*/
	background: #e3e2e2 url(" . $imgServer . "cbar/g_bkg.png) repeat-x center top;
	border: 1px solid #c9c9c9;
	border-bottom: none;
	width: 94%;
	margin: 0 3%;
	font: 10px normal Verdana, Arial, Helvetica, sans-serif;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;

}
img {border: none;}


*html #footpanel { /*--IE6 Hack - Fixed Positioning to the Bottom--*/
	margin-top: -1px; /*--prevents IE6 from having an infinity scroll bar - due to 1px border on #footpanel--*/
	position: absolute;
	top:expression(eval(document.compatMode &&document.compatMode=='CSS1Compat') ?documentElement.scrollTop+(documentElement.clientHeight-this.clientHeight) : document.body.scrollTop +(document.body.clientHeight-this.clientHeight));
}

#footpanel ul {
	padding: 0; margin: 0;
	float: left;
	width: 100%;
	list-style: none;
	font-size: 1.1em;
}
#footpanel ul li{
	padding: 0; margin: 0;
	float: left;
	position: relative;
}
#footpanel ul li a{
	padding: 5px;
	float: left;
	text-indent: -9999px;
	height: 16px; width: 16px;
	text-decoration: none;
	color: #333;
	position: relative;
}
html #footpanel ul li a:hover{	background-color: #e3e2e2; }
html #footpanel ul li a.active { /*--Active state when subpanel is open--*/
	background-color: #fff;
	height: 17px;
	margin-top: -2px; /*--Push it up 2px to attach the active button to subpanel--*/
	border: 1px solid #b2b2b2;
	border-top: none;
	z-index: 200; /*--Keeps the active area on top of the subpanel--*/
	position: relative;
	
		/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
}


#footpanel a.home{	
	background: url(" . $imgServer . "cbar/mail.png) no-repeat 7px center;
	width: 55px;
	padding-left: 30px;
	border-right: 1px solid #bbb;
	text-indent: 0; /*--Reset text indent--*/
}
#footpanel a.livelecture{
background: url(" . $imgServer . "main/alert.png) no-repeat 7px center;
	width: 170px;
	padding-left: 30px;
	text-indent: 0; /*--Reset text indent--*/
        color:#fff;
        font-weight:bolder;
    }
#footpanel a.livelecture:hover{
    color: #000;
}
#footpanel a.calculator{	background: url(" . $imgServer . "cbar/calc.png) no-repeat center center;  }
#footpanel a.img_search{	background: url(" . $imgServer . "cbar/img_search.png) no-repeat center center;  }
#footpanel a.feedback{	background: url(" . $imgServer . "cbar/feedback.png) no-repeat center center;  }
#footpanel a.helper{	background: url(" . $imgServer . "cbar/help.png) no-repeat center center;  }
#footpanel a.chat{	
	background: url(" . $imgServer . "cbar/address_book.png) no-repeat 15px center;
	width: 126px;
	border-left: 1px solid #bbb;
	border-right: 1px solid #bbb;
	padding-left: 40px;
	text-indent: 0; /*--Reset text indent--*/
}
#footpanel a.alerts{	
background: url(" . $imgServer . "cbar/not.png) no-repeat 5px center;
	width: 40px;
	text-indent: 0; /*--Reset text indent--*/

	 }
#footpanel .hasNot {
	color: #fff;
	font-weight:bolder;
	width:12px;
	margin-left:20px;
	padding-bottom: 10px;
	text-align:center;
	border: 1px solid #999; 
	padding: 1px 5px 2px; 
	background: #fa0000; 
	border-radius: 6px; 
	-moz-border-radius: 6px; 
	-webkit-border-radius: 6px; 
}

#footpanel .hasMsg {
	color: #fff;
	font-weight:bolder;
	width:12px;
	margin-left:30px;
	padding-bottom: 10px;
	text-align:center;
	border: 1px solid #999; 
	padding: 1px 5px 2px; 
	background: #fa0000; 
	border-radius: 6px; 
	-moz-border-radius: 6px; 
	-webkit-border-radius: 6px; 
}

#footpanel .noNot {
	color: #000;
	font-weight:bolder;
	width:10px;
	margin-left:20px;
	padding-bottom: 10px;
	text-align:center;
	border     : 1px solid #999; 
	padding    : 1px 5px 2px; 
	background : #FFFFFF; 
	border-radius         : 6px; 
	-moz-border-radius    : 6px; 
	-webkit-border-radius : 6px; 
}

#footpanel .noMsg {
	color: #000;
	font-weight:bolder;
	width:10px;
	margin-left:30px;
	padding-bottom: 10px;
	text-align:center;
	border     : 1px solid #999; 
	padding    : 1px 5px 2px; 
	background : #FFFFFF; 
	border-radius         : 6px; 
	-moz-border-radius    : 6px; 
	-webkit-border-radius : 6px; 
}

#footpanel li#chatpanel, #footpanel li#alertpanel, #footpanel li#livelecture {float: right; }  /*--Right align the chat and alert panels--*/

#footpanel a small {  /*--panel tool tip styles--*/
	text-align: center;
	width: 70px;
	background: url(" . $imgServer . "cbar/pop_arrow.gif) no-repeat center bottom;
	padding: 5px 5px 11px;
	display: none; /*--Hide by default--*/
	color: #fff;
	font-size: 1em;
	text-indent: 0;
}
#footpanel a:hover small{
	display: block; /*--Show on hover--*/
	position: absolute;
	top: -35px; /*--Position tooltip 35px above the list item--*/
	left: 50%; 
	margin-left: -40px; /*--Center the tooltip--*/
	z-index: 9997;
}





#footpanel ul li div a { /*--Reset link style for subpanel links--*/
	text-indent: 0;
	width: auto;
	height: auto;
	padding: 0;
	float: none;
	color: #00629a;
	position: static;
}
#footpanel ul li div a:hover {	text-decoration: underline; } /*--Reset link style for subpanel links--*/

#footpanel .subpanel {
	position: absolute;
	left: 0; bottom: 27px;
	display: none;	/*--Hide by default--*/
	width: 198px;
	border-right: 1px solid #b3b3b3;
	border-left: 1px solid #b3b3b3;
	border-bottom: 1px solid #b3b3b3;
	background: #fff;
	overflow: hidden;
	padding-bottom: 2px;
		/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}
#footpanel h3 {
	background: #e3e2e2 url(" . $imgServer . "cbar/g_bkg.png) repeat-x center top;
	border: 1px solid #b3b3b3;
                   border-left:none;
                   border-right:none;
	padding: 5px 10px;
	color: #000;
	font-size: 1.1em;
	cursor: pointer;
			/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}
#footpanel h3 span { 
	font-size: 1.5em;
	float: right;
	line-height: 0.6em;	
	font-weight: normal;
}
#footpanel .subpanel ul{
	padding: 0; margin: 0;
	background: #fff;
	width: 100%;
	overflow: auto;
}
#footpanel .subpanel li{ 
	float: none; /*--Reset float--*/
	display: block;
	padding: 0; margin: 0;
	overflow: hidden;
	clear: both;
	background: #fff;
	position: static;  /*--Reset relative positioning--*/
	font-size: 0.9em;
}

#chatpanel .subpanel li { background: url(" . $imgServer . "cbar/dash.gif) repeat-x left center; } 
#chatpanel .subpanel li span {
	padding: 5px;
	background: #fff;
	color: #777;
	float: left;
}
#chatpanel .subpanel li a img {
	float: left;
	margin: 0 5px;
}
#chatpanel .subpanel li a{
	padding: 3px 0;	margin: 0;
	line-height: 22px;
	height: 22px;
	background: #fff;
	display: block;
}
#chatpanel .subpanel li a:hover {
	background: " . $color . ";
	color: #fff;
	text-decoration: none;
}


#alertpanel .subpanel { right: 0; left: auto; /*--Reset left positioning and make it right positioned--*/ }
#alertpanel .subpanel li {
	border-top: 1px solid #f0f0f0;
	display: block;
}
#alertpanel .subpanel li p {
	padding-bottom:10px;
}
#alertpanel .subpanel li a.delete{
	background: url(" . $imgServer . "cbar/delete_x.gif) no-repeat;
	float: right;
	width: 13px; height: 14px;
	margin: 5px;
	text-indent: -9999px;
	visibility: hidden; /*--Hides by default but still takes up space (not completely gone like display:none;)--*/
}
#alertpanel .subpanel li a.delete:hover { background-color: " . $color . "; }
#footpanel #alertpanel li.view {
	text-align: right;
	padding: 5px 10px 5px 0;
}

.page_heading{
	font-size: 23px;
	color:#666666;
}

#latestBox {
background: #ffffff url(" . $imgServer . "main/latest_rep.png) repeat-x bottom;
border-left: 1px solid #f3f3f3;
border-right: 1px solid #f3f3f3;
padding-left:10px;
padding-bottom: 5px;
}
#latestBox .status{
    font-size:16px;
    color: #000000;
}

#latestBox .posted_at{
    font-size:12px;
    color: #666;
}

#updateBox {
background: #e5e5df url(" . $imgServer . "main/update_rep.png) repeat-x;
padding:5px;
border: 1px solid #BABABA;
height:31px;
}

#updateBox .inputBox{
-moz-border-radius: 0px;
-khtml-border-radius: 0px;
-webkit-border-radius: 0px;
font-size:16px;
padding:5px;
width:610px;
border: 1px solid #BABABA;
float:left;
outline: none;
}

#updateBox .postButton {
	float:left;
	background: " . $color . " url(" . $imgServer . "main/sub_rep.png) repeat-x;
                  color: #fff;
	font-size:16px;
	width:100px;
	height: 31px;
	border: 1px solid #999;
	outline: none;
        padding-top:5px;
        font-weight:bolder;
        margin-left:5px;
        -moz-border-radius: 0px;
-khtml-border-radius: 0px;
-webkit-border-radius: 0px;
}



.commentbox{
background-color: #ececec;
width: 730px;
padding: 10px;
		/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
	overflow-x: hidden; overflow-y: auto;
}
.commentfooter{
background: url(" . $imgServer . "main/arrow.gif) 20px 0 no-repeat; /*20px 0 equals horizontal and vertical position of arrow. Adjust as desired (ie: 20px -5px).*/
padding-left: 58px;
padding-top: 1px;
margin-bottom: 2em;
font-size: 90%;
color: #4A4A4A;
}
.commentboxup{
background-color: #ececec;
width: 730px;
padding: 10px;
margin-bottom: 2em;
		/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
	overflow-x: hidden; overflow-y: auto;
}
.commentfooterup{
background: url(" . $imgServer . "main/light_up.gif) 20px 0 no-repeat; /*20px 0 equals horizontal and vertical position of arrow. Adjust as desired (ie: 20px -5px).*/
padding-left: 58px;
padding-top: 1px;
font-size: 90%;
color: #4A4A4A;
}
.darkcommentbox{
background-color: #ccc;
width: 730px;
padding: 10px;
		/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
	overflow-x: hidden; overflow-y: auto;
}
.darkcommentfooter{
background: url(" . $imgServer . "main/darkdown.gif) 20px 0 no-repeat; /*20px 0 equals horizontal and vertical position of arrow. Adjust as desired (ie: 20px -5px).*/
padding-left: 58px;
padding-top: 1px;
margin-bottom: 2em;
font-size: 90%;
color: #4A4A4A;
}
.recommentbox{
background-color: #ccc;
width: 650px;
margin-left:80px;
padding: 10px;
		/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
	margin-bottom: 2em;
	overflow-x: hidden; overflow-y: auto;
}
.recommentheader{
background: url(" . $imgServer . "main/arrow_inv.gif) 20px 0 no-repeat; /*20px 0 equals horizontal and vertical position of arrow. Adjust as desired (ie: 20px -5px).*/
padding-left: 58px;
margin-left:80px;
padding-top: 1px;
font-size: 90%;
color: #4A4A4A;
}
.recommentbox1{
background-color: #ececec;
width: 650px;
margin-left:80px;
padding: 10px;
		/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
	margin-bottom: 2em;
	overflow-x: hidden; overflow-y: auto;
}
.recommentheader1{
background: url(" . $imgServer . "main/light_up.gif) 20px 0 no-repeat; /*20px 0 equals horizontal and vertical position of arrow. Adjust as desired (ie: 20px -5px).*/
padding-left: 58px;
margin-left:80px;
padding-top: 1px;
font-size: 90%;
color: #4A4A4A;
}


#lightbox {  
 display:none;  
 background:" . $color . ";
 position:absolute;  
 top:0px;  
 left:0px;  
 min-width:100%;  
 min-height:100%;  
 z-index:1000;  
}  

#lightbox-panel { 
 font-size:14px; 
 display:none;  
 position:absolute;  
 top:30px;  
 left:50%;  
 margin-left:-330px;  
 width:600px; 
 background:#FFFFFF;  
 padding:10px 15px 10px 15px;  
 border:6px solid #999;  
 z-index:1001;  
 
 	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
   
   -moz-box-shadow: 0 0 100px #ccc;
  -webkit-box-shadow: 0 0 100px #ccc;
  box-shadow: 0 0 100px #ccc;
} 
#lightbox-panel input {
	border: 1px solid #999;
	font-size:14px;
	padding-top:3px;
	padding-bottom:3px;
	padding-left:3px;
	
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}



/* cc dialog box */

#blackbox {  
 display:none;  
 background:#000000;  
 opacity:0.9;  
 filter:alpha(opacity=90);  
 position:fixed;  
 top:0px;  
 left:0px;  
 min-width:100%;  
 min-height:100%;  
 z-index:9998;  
}  
#clearbox {  
 display:none;  
 position:absolute;  
 top:0px;  
 left:0px;  
 min-width:100%;  
 min-height:100%;  
 z-index:9998;  
}  
/* Lightbox panel with some content */  
#dialogBox {  
 display:none;  
 position:absolute;  
 top:100px;  
 left:50%;  
 background:#FFFFFF;   
  border:6px solid #999;  
 z-index:9999; 
 /*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px; 
	
	-moz-box-shadow: 0 0 20px #ccc;
  -webkit-box-shadow: 0 0 20px #ccc;
  box-shadow: 0 0 20px #ccc;
}
#dialogBox .headTitle{ 
	background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
	height: 40px;
	border-bottom:1px solid #999;
	font-size:20px;
	padding-left:10px;
	overflow:hidden;
}
#dialogBox .headTitle div{ 
	padding-top: 5px;
	padding-bottom: 5px;
}
#dialogBox .headTitle img{ 

	float:left;
}

/* buttons */

a.button, button.button {
  background-color: #f4f4f4;
  background-image: url(\"" . $imgServer . "gen/button-background.png\");
  border: 1px solid #c3c4ba;
  font-family: helvetica, arial, sans-serif;
  font-weight: normal;
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}

a.button:link, a.button:visited, a.button:hover, a.button:active, button.button:link, button.button:visited, button.button:hover, button.button:active {
  font-weight: normal;
  background-color: #f4f4f4;
}

a.button:hover, button.button:hover {
  background-color: #eee;
  border: 1px solid #818171;
  -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
  -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
  box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
}

a.button:active, button.button:active {
  outline: none;
  background-color: #ddd;
  background-image: url(\"" . $imgServer . "gen/button-background-active.png\");
}

a.button:link, a.button:visited, a.button:hover, a.button:active, button.button {
  color: #222;
  display:block;
  float:left;
  margin:0 7px 0 0;
  background-color: #eee;
  border:1px solid #bfbfbf;
  font-size: 1em;
  line-height: 1.3em;
  cursor:pointer;
  padding:5px 10px 6px 7px;
  text-decoration: none;
  font-size:14px;
}

button.button {
  width:auto;
  overflow:visible;
  padding:4px 10px 3px 7px; /* IE6 */
}
button.button[type] {
  padding:5px 10px 5px 7px; /* Firefox */
  line-height:17px; /* Safari */
}

*:first-child+html button.button[type] {
  padding:4px 10px 3px 7px; /* IE7 */
}

button.button img, a.button img {
  margin:0 3px -3px 0 !important;
  padding:0;
  border:none;
  width:16px;
  height:16px;
}

button.button:hover, a.button:hover {
  background-color:#dedede;
}

button.button:active, a.button:active {
  background-color:#e5e5e5;
}




.infobox  
{  
    background-color: #fff9d7;  
    border: 1px solid #e2c822;  
    color: #333333;  
    padding: 10px;  
    font-size: 13px;  
}  
.errorbox  
{  
    background-color: #ffebe8;  
    border: 1px solid #dd3c10;  
    color: #333333;  
    padding: 10px;  
    font-size: 13px;   
} 
.successbox  
{  
    background-color: #bbffb6;  
    border: 1px solid #1fdf00;  
    color: #333333;  
    padding: 10px;  
    font-size: 13px;   
} 

span.highlight{
       background:#FCFFA3;
       padding:3px;
       font-weight:bold;
}


div.sdmenu {
	margin-top: 5px;
	width: 180px;
	font-size: 12px;
	padding-bottom: 10px;
		/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}
div.sdmenu div {
	background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
	overflow: hidden;
	border-bottom: 1px solid #ccc;
	border-left: 1px solid #ccc;
	border-right: 1px solid #ccc;
}
div.sdmenu div:first-child {
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
	background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
	border-bottom: 1px solid #ccc;
	border-top: 1px solid #ccc;
}
div.sdmenu div:last-child {
			/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
	border-bottom: 1px solid #ccc;
}
div.sdmenu div.collapsed {
	height: 25px;
}
div.sdmenu div span {
	display: block;
	padding: 5px 25px;
	font-weight: bold;
	background: url(" . $imgServer . "/menu/expanded.gif) no-repeat 10px center;
	cursor: default;
	border-bottom: 1px solid #ddd;
}
div.sdmenu div.collapsed span {
	background-image: url(" . $imgServer . "/menu/collapsed.gif);
}
div.sdmenu div a {
	padding: 5px 10px;
	background: #eee;
	display: block;
	border-bottom: 1px solid #ddd;
	}
div.sdmenu div a.current {

}
div.sdmenu div a:hover {
	background : " . $color . ";
	color: #fff;
	text-decoration: none;
}

#adminPanel {
	width:700px;
	float:right;
}

#adminPanel input {
	border: 1px solid #999;
	font-size:14px;
	padding-top:3px;
	padding-bottom:3px;
	padding-left:3px;
	
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}

#adminPanel textarea {
	border: 1px solid #999;
	font-size:14px;
	padding-top:3px;
	padding-bottom:3px;
	padding-left:3px;
	
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}

#colorme {
	padding:10px;
	font-size:16px;
	border: 1px solid #aaa;
	width:330px;
	margin-left:20px;
	margin-top:30px;
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}
























/*
 * jQuery UI CSS Framework 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Theming/API
 */

/* Layout helpers
----------------------------------*/
.ui-helper-hidden { display: none; }
.ui-helper-hidden-accessible { position: absolute !important; clip: rect(1px 1px 1px 1px); clip: rect(1px,1px,1px,1px); }
.ui-helper-reset { margin: 0; padding: 0; border: 0; outline: 0; line-height: 1.3; text-decoration: none; font-size: 100%; list-style: none; }
.ui-helper-clearfix:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }
.ui-helper-clearfix { display: inline-block; }
/* required comment for clearfix to work in Opera \*/
* html .ui-helper-clearfix { height:1%; }
.ui-helper-clearfix { display:block; }
/* end clearfix */
.ui-helper-zfix { width: 100%; height: 100%; top: 0; left: 0; position: absolute; opacity: 0; filter:Alpha(Opacity=0); }


/* Interaction Cues
----------------------------------*/
.ui-state-disabled { cursor: default !important; }


/* Icons
----------------------------------*/

/* states and images */
.ui-icon { display: block; text-indent: -99999px; overflow: hidden; background-repeat: no-repeat; }


/* Misc visuals
----------------------------------*/

/* Overlays */
.ui-widget-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }


/*
 * jQuery UI CSS Framework 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Theming/API
 *
 * To view and modify this theme, visit http://jqueryui.com/themeroller/?ffDefault=Lucida%20Grande,%20Lucida%20Sans,%20Arial,%20sans-serif&fwDefault=bold&fsDefault=1.1em&cornerRadius=6px&bgColorHeader=a3a3a3&bgTextureHeader=02_glass.png&bgImgOpacityHeader=25&borderColorHeader=969696&fcHeader=ffffff&iconColorHeader=a8a8a8&bgColorContent=ffffff&bgTextureContent=12_gloss_wave.png&bgImgOpacityContent=30&borderColorContent=b3b3b3&fcContent=000000&iconColorContent=ffffff&bgColorDefault=dcd9de&bgTextureDefault=03_highlight_soft.png&bgImgOpacityDefault=100&borderColorDefault=dcd9de&fcDefault=5e5e5e&iconColorDefault=5e5e5e&bgColorHover=eae6ea&bgTextureHover=03_highlight_soft.png&bgImgOpacityHover=100&borderColorHover=d1c5d8&fcHover=000000&iconColorHover=000000&bgColorActive=5f5964&bgTextureActive=03_highlight_soft.png&bgImgOpacityActive=45&borderColorActive=787878&fcActive=ffffff&iconColorActive=454545&bgColorHighlight=fafafa&bgTextureHighlight=01_flat.png&bgImgOpacityHighlight=55&borderColorHighlight=ffdb1f&fcHighlight=333333&iconColorHighlight=7d7d7d&bgColorError=994d53&bgTextureError=01_flat.png&bgImgOpacityError=55&borderColorError=994d53&fcError=ffffff&iconColorError=ebccce&bgColorOverlay=eeeeee&bgTextureOverlay=01_flat.png&bgImgOpacityOverlay=0&opacityOverlay=80&bgColorShadow=aaaaaa&bgTextureShadow=01_flat.png&bgImgOpacityShadow=0&opacityShadow=60&thicknessShadow=4px&offsetTopShadow=-4px&offsetLeftShadow=-4px&cornerRadiusShadow=0px
 */


/* Component containers
----------------------------------*/
.ui-widget { font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; font-size: 1.1em; }
.ui-widget .ui-widget { font-size: 1em; }
.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button { font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; font-size: 1em; }
.ui-widget-content { border: 1px solid #b3b3b3; background: #ffffff url(images/ui-bg_gloss-wave_30_ffffff_500x100.png) 50% top repeat-x; color: #000000; }
.ui-widget-content a { color: #000000; }
.ui-widget-header { border: 1px solid #969696; background: #a3a3a3 url(images/ui-bg_glass_25_a3a3a3_1x400.png) 50% 50% repeat-x; color: #ffffff; font-weight: bold; }
.ui-widget-header a { color: #ffffff; }

/* Interaction states
----------------------------------*/
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default { border: 1px solid #dcd9de; background: #dcd9de url(images/ui-bg_highlight-soft_100_dcd9de_1x100.png) 50% 50% repeat-x; font-weight: bold; color: #5e5e5e; }
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited { color: #5e5e5e; text-decoration: none; }
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus { border: 1px solid #d1c5d8; background: #eae6ea url(images/ui-bg_highlight-soft_100_eae6ea_1x100.png) 50% 50% repeat-x; font-weight: bold; color: #000000; }
.ui-state-hover a, .ui-state-hover a:hover { color: #000000; text-decoration: none; }
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active { border: 1px solid #787878; background: #5f5964 url(images/ui-bg_highlight-soft_45_5f5964_1x100.png) 50% 50% repeat-x; font-weight: bold; color: #ffffff; }
.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited { color: #ffffff; text-decoration: none; }
.ui-widget :active { outline: none; }

/* Interaction Cues
----------------------------------*/
.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight  {border: 1px solid #ffdb1f; background: #fafafa url(images/ui-bg_flat_55_fafafa_40x100.png) 50% 50% repeat-x; color: #333333; }
.ui-state-highlight a, .ui-widget-content .ui-state-highlight a,.ui-widget-header .ui-state-highlight a { color: #333333; }
.ui-state-error, .ui-widget-content .ui-state-error, .ui-widget-header .ui-state-error {border: 1px solid #994d53; background: #994d53 url(images/ui-bg_flat_55_994d53_40x100.png) 50% 50% repeat-x; color: #ffffff; }
.ui-state-error a, .ui-widget-content .ui-state-error a, .ui-widget-header .ui-state-error a { color: #ffffff; }
.ui-state-error-text, .ui-widget-content .ui-state-error-text, .ui-widget-header .ui-state-error-text { color: #ffffff; }
.ui-priority-primary, .ui-widget-content .ui-priority-primary, .ui-widget-header .ui-priority-primary { font-weight: bold; }
.ui-priority-secondary, .ui-widget-content .ui-priority-secondary,  .ui-widget-header .ui-priority-secondary { opacity: .7; filter:Alpha(Opacity=70); font-weight: normal; }
.ui-state-disabled, .ui-widget-content .ui-state-disabled, .ui-widget-header .ui-state-disabled { opacity: .35; filter:Alpha(Opacity=35); background-image: none; }

/* Icons
----------------------------------*/

/* states and images */
.ui-icon { width: 16px; height: 16px; background-image: url(images/ui-icons_ffffff_256x240.png); }
.ui-widget-content .ui-icon {background-image: url(images/ui-icons_ffffff_256x240.png); }
.ui-widget-header .ui-icon {background-image: url(images/ui-icons_a8a8a8_256x240.png); }
.ui-state-default .ui-icon { background-image: url(images/ui-icons_5e5e5e_256x240.png); }
.ui-state-hover .ui-icon, .ui-state-focus .ui-icon {background-image: url(images/ui-icons_000000_256x240.png); }
.ui-state-active .ui-icon {background-image: url(images/ui-icons_454545_256x240.png); }
.ui-state-highlight .ui-icon {background-image: url(images/ui-icons_7d7d7d_256x240.png); }
.ui-state-error .ui-icon, .ui-state-error-text .ui-icon {background-image: url(images/ui-icons_ebccce_256x240.png); }

/* positioning */
.ui-icon-carat-1-n { background-position: 0 0; }
.ui-icon-carat-1-ne { background-position: -16px 0; }
.ui-icon-carat-1-e { background-position: -32px 0; }
.ui-icon-carat-1-se { background-position: -48px 0; }
.ui-icon-carat-1-s { background-position: -64px 0; }
.ui-icon-carat-1-sw { background-position: -80px 0; }
.ui-icon-carat-1-w { background-position: -96px 0; }
.ui-icon-carat-1-nw { background-position: -112px 0; }
.ui-icon-carat-2-n-s { background-position: -128px 0; }
.ui-icon-carat-2-e-w { background-position: -144px 0; }
.ui-icon-triangle-1-n { background-position: 0 -16px; }
.ui-icon-triangle-1-ne { background-position: -16px -16px; }
.ui-icon-triangle-1-e { background-position: -32px -16px; }
.ui-icon-triangle-1-se { background-position: -48px -16px; }
.ui-icon-triangle-1-s { background-position: -64px -16px; }
.ui-icon-triangle-1-sw { background-position: -80px -16px; }
.ui-icon-triangle-1-w { background-position: -96px -16px; }
.ui-icon-triangle-1-nw { background-position: -112px -16px; }
.ui-icon-triangle-2-n-s { background-position: -128px -16px; }
.ui-icon-triangle-2-e-w { background-position: -144px -16px; }
.ui-icon-arrow-1-n { background-position: 0 -32px; }
.ui-icon-arrow-1-ne { background-position: -16px -32px; }
.ui-icon-arrow-1-e { background-position: -32px -32px; }
.ui-icon-arrow-1-se { background-position: -48px -32px; }
.ui-icon-arrow-1-s { background-position: -64px -32px; }
.ui-icon-arrow-1-sw { background-position: -80px -32px; }
.ui-icon-arrow-1-w { background-position: -96px -32px; }
.ui-icon-arrow-1-nw { background-position: -112px -32px; }
.ui-icon-arrow-2-n-s { background-position: -128px -32px; }
.ui-icon-arrow-2-ne-sw { background-position: -144px -32px; }
.ui-icon-arrow-2-e-w { background-position: -160px -32px; }
.ui-icon-arrow-2-se-nw { background-position: -176px -32px; }
.ui-icon-arrowstop-1-n { background-position: -192px -32px; }
.ui-icon-arrowstop-1-e { background-position: -208px -32px; }
.ui-icon-arrowstop-1-s { background-position: -224px -32px; }
.ui-icon-arrowstop-1-w { background-position: -240px -32px; }
.ui-icon-arrowthick-1-n { background-position: 0 -48px; }
.ui-icon-arrowthick-1-ne { background-position: -16px -48px; }
.ui-icon-arrowthick-1-e { background-position: -32px -48px; }
.ui-icon-arrowthick-1-se { background-position: -48px -48px; }
.ui-icon-arrowthick-1-s { background-position: -64px -48px; }
.ui-icon-arrowthick-1-sw { background-position: -80px -48px; }
.ui-icon-arrowthick-1-w { background-position: -96px -48px; }
.ui-icon-arrowthick-1-nw { background-position: -112px -48px; }
.ui-icon-arrowthick-2-n-s { background-position: -128px -48px; }
.ui-icon-arrowthick-2-ne-sw { background-position: -144px -48px; }
.ui-icon-arrowthick-2-e-w { background-position: -160px -48px; }
.ui-icon-arrowthick-2-se-nw { background-position: -176px -48px; }
.ui-icon-arrowthickstop-1-n { background-position: -192px -48px; }
.ui-icon-arrowthickstop-1-e { background-position: -208px -48px; }
.ui-icon-arrowthickstop-1-s { background-position: -224px -48px; }
.ui-icon-arrowthickstop-1-w { background-position: -240px -48px; }
.ui-icon-arrowreturnthick-1-w { background-position: 0 -64px; }
.ui-icon-arrowreturnthick-1-n { background-position: -16px -64px; }
.ui-icon-arrowreturnthick-1-e { background-position: -32px -64px; }
.ui-icon-arrowreturnthick-1-s { background-position: -48px -64px; }
.ui-icon-arrowreturn-1-w { background-position: -64px -64px; }
.ui-icon-arrowreturn-1-n { background-position: -80px -64px; }
.ui-icon-arrowreturn-1-e { background-position: -96px -64px; }
.ui-icon-arrowreturn-1-s { background-position: -112px -64px; }
.ui-icon-arrowrefresh-1-w { background-position: -128px -64px; }
.ui-icon-arrowrefresh-1-n { background-position: -144px -64px; }
.ui-icon-arrowrefresh-1-e { background-position: -160px -64px; }
.ui-icon-arrowrefresh-1-s { background-position: -176px -64px; }
.ui-icon-arrow-4 { background-position: 0 -80px; }
.ui-icon-arrow-4-diag { background-position: -16px -80px; }
.ui-icon-extlink { background-position: -32px -80px; }
.ui-icon-newwin { background-position: -48px -80px; }
.ui-icon-refresh { background-position: -64px -80px; }
.ui-icon-shuffle { background-position: -80px -80px; }
.ui-icon-transfer-e-w { background-position: -96px -80px; }
.ui-icon-transferthick-e-w { background-position: -112px -80px; }
.ui-icon-folder-collapsed { background-position: 0 -96px; }
.ui-icon-folder-open { background-position: -16px -96px; }
.ui-icon-document { background-position: -32px -96px; }
.ui-icon-document-b { background-position: -48px -96px; }
.ui-icon-note { background-position: -64px -96px; }
.ui-icon-mail-closed { background-position: -80px -96px; }
.ui-icon-mail-open { background-position: -96px -96px; }
.ui-icon-suitcase { background-position: -112px -96px; }
.ui-icon-comment { background-position: -128px -96px; }
.ui-icon-person { background-position: -144px -96px; }
.ui-icon-print { background-position: -160px -96px; }
.ui-icon-trash { background-position: -176px -96px; }
.ui-icon-locked { background-position: -192px -96px; }
.ui-icon-unlocked { background-position: -208px -96px; }
.ui-icon-bookmark { background-position: -224px -96px; }
.ui-icon-tag { background-position: -240px -96px; }
.ui-icon-home { background-position: 0 -112px; }
.ui-icon-flag { background-position: -16px -112px; }
.ui-icon-calendar { background-position: -32px -112px; }
.ui-icon-cart { background-position: -48px -112px; }
.ui-icon-pencil { background-position: -64px -112px; }
.ui-icon-clock { background-position: -80px -112px; }
.ui-icon-disk { background-position: -96px -112px; }
.ui-icon-calculator { background-position: -112px -112px; }
.ui-icon-zoomin { background-position: -128px -112px; }
.ui-icon-zoomout { background-position: -144px -112px; }
.ui-icon-search { background-position: -160px -112px; }
.ui-icon-wrench { background-position: -176px -112px; }
.ui-icon-gear { background-position: -192px -112px; }
.ui-icon-heart { background-position: -208px -112px; }
.ui-icon-star { background-position: -224px -112px; }
.ui-icon-link { background-position: -240px -112px; }
.ui-icon-cancel { background-position: 0 -128px; }
.ui-icon-plus { background-position: -16px -128px; }
.ui-icon-plusthick { background-position: -32px -128px; }
.ui-icon-minus { background-position: -48px -128px; }
.ui-icon-minusthick { background-position: -64px -128px; }
.ui-icon-close { background-position: -80px -128px; }
.ui-icon-closethick { background-position: -96px -128px; }
.ui-icon-key { background-position: -112px -128px; }
.ui-icon-lightbulb { background-position: -128px -128px; }
.ui-icon-scissors { background-position: -144px -128px; }
.ui-icon-clipboard { background-position: -160px -128px; }
.ui-icon-copy { background-position: -176px -128px; }
.ui-icon-contact { background-position: -192px -128px; }
.ui-icon-image { background-position: -208px -128px; }
.ui-icon-video { background-position: -224px -128px; }
.ui-icon-script { background-position: -240px -128px; }
.ui-icon-alert { background-position: 0 -144px; }
.ui-icon-info { background-position: -16px -144px; }
.ui-icon-notice { background-position: -32px -144px; }
.ui-icon-help { background-position: -48px -144px; }
.ui-icon-check { background-position: -64px -144px; }
.ui-icon-bullet { background-position: -80px -144px; }
.ui-icon-radio-off { background-position: -96px -144px; }
.ui-icon-radio-on { background-position: -112px -144px; }
.ui-icon-pin-w { background-position: -128px -144px; }
.ui-icon-pin-s { background-position: -144px -144px; }
.ui-icon-play { background-position: 0 -160px; }
.ui-icon-pause { background-position: -16px -160px; }
.ui-icon-seek-next { background-position: -32px -160px; }
.ui-icon-seek-prev { background-position: -48px -160px; }
.ui-icon-seek-end { background-position: -64px -160px; }
.ui-icon-seek-start { background-position: -80px -160px; }
/* ui-icon-seek-first is deprecated, use ui-icon-seek-start instead */
.ui-icon-seek-first { background-position: -80px -160px; }
.ui-icon-stop { background-position: -96px -160px; }
.ui-icon-eject { background-position: -112px -160px; }
.ui-icon-volume-off { background-position: -128px -160px; }
.ui-icon-volume-on { background-position: -144px -160px; }
.ui-icon-power { background-position: 0 -176px; }
.ui-icon-signal-diag { background-position: -16px -176px; }
.ui-icon-signal { background-position: -32px -176px; }
.ui-icon-battery-0 { background-position: -48px -176px; }
.ui-icon-battery-1 { background-position: -64px -176px; }
.ui-icon-battery-2 { background-position: -80px -176px; }
.ui-icon-battery-3 { background-position: -96px -176px; }
.ui-icon-circle-plus { background-position: 0 -192px; }
.ui-icon-circle-minus { background-position: -16px -192px; }
.ui-icon-circle-close { background-position: -32px -192px; }
.ui-icon-circle-triangle-e { background-position: -48px -192px; }
.ui-icon-circle-triangle-s { background-position: -64px -192px; }
.ui-icon-circle-triangle-w { background-position: -80px -192px; }
.ui-icon-circle-triangle-n { background-position: -96px -192px; }
.ui-icon-circle-arrow-e { background-position: -112px -192px; }
.ui-icon-circle-arrow-s { background-position: -128px -192px; }
.ui-icon-circle-arrow-w { background-position: -144px -192px; }
.ui-icon-circle-arrow-n { background-position: -160px -192px; }
.ui-icon-circle-zoomin { background-position: -176px -192px; }
.ui-icon-circle-zoomout { background-position: -192px -192px; }
.ui-icon-circle-check { background-position: -208px -192px; }
.ui-icon-circlesmall-plus { background-position: 0 -208px; }
.ui-icon-circlesmall-minus { background-position: -16px -208px; }
.ui-icon-circlesmall-close { background-position: -32px -208px; }
.ui-icon-squaresmall-plus { background-position: -48px -208px; }
.ui-icon-squaresmall-minus { background-position: -64px -208px; }
.ui-icon-squaresmall-close { background-position: -80px -208px; }
.ui-icon-grip-dotted-vertical { background-position: 0 -224px; }
.ui-icon-grip-dotted-horizontal { background-position: -16px -224px; }
.ui-icon-grip-solid-vertical { background-position: -32px -224px; }
.ui-icon-grip-solid-horizontal { background-position: -48px -224px; }
.ui-icon-gripsmall-diagonal-se { background-position: -64px -224px; }
.ui-icon-grip-diagonal-se { background-position: -80px -224px; }


/* Misc visuals
----------------------------------*/

/* Corner radius */
.ui-corner-tl { -moz-border-radius-topleft: 6px; -webkit-border-top-left-radius: 6px; border-top-left-radius: 6px; }
.ui-corner-tr { -moz-border-radius-topright: 6px; -webkit-border-top-right-radius: 6px; border-top-right-radius: 6px; }
.ui-corner-bl { -moz-border-radius-bottomleft: 6px; -webkit-border-bottom-left-radius: 6px; border-bottom-left-radius: 6px; }
.ui-corner-br { -moz-border-radius-bottomright: 6px; -webkit-border-bottom-right-radius: 6px; border-bottom-right-radius: 6px; }
.ui-corner-top { -moz-border-radius-topleft: 6px; -webkit-border-top-left-radius: 6px; border-top-left-radius: 6px; -moz-border-radius-topright: 6px; -webkit-border-top-right-radius: 6px; border-top-right-radius: 6px; }
.ui-corner-bottom { -moz-border-radius-bottomleft: 6px; -webkit-border-bottom-left-radius: 6px; border-bottom-left-radius: 6px; -moz-border-radius-bottomright: 6px; -webkit-border-bottom-right-radius: 6px; border-bottom-right-radius: 6px; }
.ui-corner-right {  -moz-border-radius-topright: 6px; -webkit-border-top-right-radius: 6px; border-top-right-radius: 6px; -moz-border-radius-bottomright: 6px; -webkit-border-bottom-right-radius: 6px; border-bottom-right-radius: 6px; }
.ui-corner-left { -moz-border-radius-topleft: 6px; -webkit-border-top-left-radius: 6px; border-top-left-radius: 6px; -moz-border-radius-bottomleft: 6px; -webkit-border-bottom-left-radius: 6px; border-bottom-left-radius: 6px; }
.ui-corner-all { -moz-border-radius: 6px; -webkit-border-radius: 6px; border-radius: 6px; }

/* Overlays */
.ui-widget-overlay { background: #eeeeee url(images/ui-bg_flat_0_eeeeee_40x100.png) 50% 50% repeat-x; opacity: .80;filter:Alpha(Opacity=80); }
.ui-widget-shadow { margin: -4px 0 0 -4px; padding: 4px; background: #aaaaaa url(images/ui-bg_flat_0_aaaaaa_40x100.png) 50% 50% repeat-x; opacity: .60;filter:Alpha(Opacity=60); -moz-border-radius: 0px; -webkit-border-radius: 0px; border-radius: 0px; }/*
 * jQuery UI Resizable 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Resizable#theming
 */
.ui-resizable { position: relative;}
.ui-resizable-handle { position: absolute;font-size: 0.1px;z-index: 99999; display: block;}
.ui-resizable-disabled .ui-resizable-handle, .ui-resizable-autohide .ui-resizable-handle { display: none; }
.ui-resizable-n { cursor: n-resize; height: 7px; width: 100%; top: -5px; left: 0; }
.ui-resizable-s { cursor: s-resize; height: 7px; width: 100%; bottom: -5px; left: 0; }
.ui-resizable-e { cursor: e-resize; width: 7px; right: -5px; top: 0; height: 100%; }
.ui-resizable-w { cursor: w-resize; width: 7px; left: -5px; top: 0; height: 100%; }
.ui-resizable-se { cursor: se-resize; width: 12px; height: 12px; right: 1px; bottom: 1px; }
.ui-resizable-sw { cursor: sw-resize; width: 9px; height: 9px; left: -5px; bottom: -5px; }
.ui-resizable-nw { cursor: nw-resize; width: 9px; height: 9px; left: -5px; top: -5px; }
.ui-resizable-ne { cursor: ne-resize; width: 9px; height: 9px; right: -5px; top: -5px;}/*
 * jQuery UI Selectable 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Selectable#theming
 */
.ui-selectable-helper { position: absolute; z-index: 100; border:1px dotted black; }
/*
 * jQuery UI Accordion 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Accordion#theming
 */
/* IE/Win - Fix animation bug - #4615 */
.ui-accordion { width: 100%; }
.ui-accordion .ui-accordion-header { cursor: pointer; position: relative; margin-top: 1px; zoom: 1; }
.ui-accordion .ui-accordion-li-fix { display: inline; }
.ui-accordion .ui-accordion-header-active { border-bottom: 0 !important; }
.ui-accordion .ui-accordion-header a { display: block; font-size: 1em; padding: .5em .5em .5em .7em; }
.ui-accordion-icons .ui-accordion-header a { padding-left: 2.2em; }
.ui-accordion .ui-accordion-header .ui-icon { position: absolute; left: .5em; top: 50%; margin-top: -8px; }
.ui-accordion .ui-accordion-content { padding: 1em 2.2em; border-top: 0; margin-top: -2px; position: relative; top: 1px; margin-bottom: 2px; overflow: auto; display: none; zoom: 1; }
.ui-accordion .ui-accordion-content-active { display: block; }/*
 * jQuery UI Autocomplete 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Autocomplete#theming
 */
.ui-autocomplete { position: absolute; cursor: default; }	

/* workarounds */
* html .ui-autocomplete { width:1px; } /* without this, the menu expands to 100% in IE6 */

/*
 * jQuery UI Menu 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Menu#theming
 */
.ui-menu {
	list-style:none;
	padding: 2px;
	margin: 0;
	display:block;
	float: left;
}
.ui-menu .ui-menu {
	margin-top: -3px;
}
.ui-menu .ui-menu-item {
	margin:0;
	padding: 0;
	zoom: 1;
	float: left;
	clear: left;
	width: 100%;
}
.ui-menu .ui-menu-item a {
	text-decoration:none;
	display:block;
	padding:.2em .4em;
	line-height:1.5;
	zoom:1;
}
.ui-menu .ui-menu-item a.ui-state-hover,
.ui-menu .ui-menu-item a.ui-state-active {
	font-weight: normal;
	margin: -1px;
}
/*
 * jQuery UI Button 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Button#theming
 */
.ui-button { display: inline-block; position: relative; padding: 0; margin-right: .1em; text-decoration: none !important; cursor: pointer; text-align: center; zoom: 1; overflow: visible; } /* the overflow property removes extra width in IE */
.ui-button-icon-only { width: 2.2em; } /* to make room for the icon, a width needs to be set here */
button.ui-button-icon-only { width: 2.4em; } /* button elements seem to need a little more width */
.ui-button-icons-only { width: 3.4em; } 
button.ui-button-icons-only { width: 3.7em; } 

/*button text element */
.ui-button .ui-button-text { display: block; line-height: 1.4;  }
.ui-button-text-only .ui-button-text { padding: .4em 1em; }
.ui-button-icon-only .ui-button-text, .ui-button-icons-only .ui-button-text { padding: .4em; text-indent: -9999999px; }
.ui-button-text-icon-primary .ui-button-text, .ui-button-text-icons .ui-button-text { padding: .4em 1em .4em 2.1em; }
.ui-button-text-icon-secondary .ui-button-text, .ui-button-text-icons .ui-button-text { padding: .4em 2.1em .4em 1em; }
.ui-button-text-icons .ui-button-text { padding-left: 2.1em; padding-right: 2.1em; }
/* no icon support for input elements, provide padding by default */
input.ui-button { padding: .4em 1em; }

/*button icon element(s) */
.ui-button-icon-only .ui-icon, .ui-button-text-icon-primary .ui-icon, .ui-button-text-icon-secondary .ui-icon, .ui-button-text-icons .ui-icon, .ui-button-icons-only .ui-icon { position: absolute; top: 50%; margin-top: -8px; }
.ui-button-icon-only .ui-icon { left: 50%; margin-left: -8px; }
.ui-button-text-icon-primary .ui-button-icon-primary, .ui-button-text-icons .ui-button-icon-primary, .ui-button-icons-only .ui-button-icon-primary { left: .5em; }
.ui-button-text-icon-secondary .ui-button-icon-secondary, .ui-button-text-icons .ui-button-icon-secondary, .ui-button-icons-only .ui-button-icon-secondary { right: .5em; }
.ui-button-text-icons .ui-button-icon-secondary, .ui-button-icons-only .ui-button-icon-secondary { right: .5em; }

/*button sets*/
.ui-buttonset { margin-right: 7px; }
.ui-buttonset .ui-button { margin-left: 0; margin-right: -.3em; }

/* workarounds */
button.ui-button::-moz-focus-inner { border: 0; padding: 0; } /* reset extra padding in Firefox */
/*
 * jQuery UI Dialog 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Dialog#theming
 */
.ui-dialog { position: absolute; padding: .2em; width: 300px; overflow: hidden; }
.ui-dialog .ui-dialog-titlebar { padding: .4em 1em; position: relative;  }
.ui-dialog .ui-dialog-title { float: left; margin: .1em 16px .1em 0; } 
.ui-dialog .ui-dialog-titlebar-close { position: absolute; right: .3em; top: 50%; width: 19px; margin: -10px 0 0 0; padding: 1px; height: 18px; }
.ui-dialog .ui-dialog-titlebar-close span { display: block; margin: 1px; }
.ui-dialog .ui-dialog-titlebar-close:hover, .ui-dialog .ui-dialog-titlebar-close:focus { padding: 0; }
.ui-dialog .ui-dialog-content { position: relative; border: 0; padding: .5em 1em; background: none; overflow: auto; zoom: 1; }
.ui-dialog .ui-dialog-buttonpane { text-align: left; border-width: 1px 0 0 0; background-image: none; margin: .5em 0 0 0; padding: .3em 1em .5em .4em; }
.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset { float: right; }
.ui-dialog .ui-dialog-buttonpane button { margin: .5em .4em .5em 0; cursor: pointer; }
.ui-dialog .ui-resizable-se { width: 14px; height: 14px; right: 3px; bottom: 3px; }
.ui-draggable .ui-dialog-titlebar { cursor: move; }
/*
 * jQuery UI Slider 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Slider#theming
 */
.ui-slider { position: relative; text-align: left; }
.ui-slider .ui-slider-handle { position: absolute; z-index: 2; width: 1.2em; height: 1.2em; cursor: default; }
.ui-slider .ui-slider-range { position: absolute; z-index: 1; font-size: .7em; display: block; border: 0; background-position: 0 0; }

.ui-slider-horizontal { height: .8em; }
.ui-slider-horizontal .ui-slider-handle { top: -.3em; margin-left: -.6em; }
.ui-slider-horizontal .ui-slider-range { top: 0; height: 100%; }
.ui-slider-horizontal .ui-slider-range-min { left: 0; }
.ui-slider-horizontal .ui-slider-range-max { right: 0; }

.ui-slider-vertical { width: .8em; height: 100px; }
.ui-slider-vertical .ui-slider-handle { left: -.3em; margin-left: 0; margin-bottom: -.6em; }
.ui-slider-vertical .ui-slider-range { left: 0; width: 100%; }
.ui-slider-vertical .ui-slider-range-min { bottom: 0; }
.ui-slider-vertical .ui-slider-range-max { top: 0; }/*
 * jQuery UI Tabs 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Tabs#theming
 */
.ui-tabs { position: relative; padding: .2em; zoom: 1; } /* position: relative prevents IE scroll bug (element with position: relative inside container with overflow: auto appear as \"fixed\") */
.ui-tabs .ui-tabs-nav { margin: 0; padding: .2em .2em 0; }
.ui-tabs .ui-tabs-nav li { list-style: none; float: left; position: relative; top: 1px; margin: 0 .2em 1px 0; border-bottom: 0 !important; padding: 0; white-space: nowrap; }
.ui-tabs .ui-tabs-nav li a { float: left; padding: .5em 1em; text-decoration: none; }
.ui-tabs .ui-tabs-nav li.ui-tabs-selected { margin-bottom: 0; padding-bottom: 1px; }
.ui-tabs .ui-tabs-nav li.ui-tabs-selected a, .ui-tabs .ui-tabs-nav li.ui-state-disabled a, .ui-tabs .ui-tabs-nav li.ui-state-processing a { cursor: text; }
.ui-tabs .ui-tabs-nav li a, .ui-tabs.ui-tabs-collapsible .ui-tabs-nav li.ui-tabs-selected a { cursor: pointer; } /* first selector in group seems obsolete, but required to overcome bug in Opera applying cursor: text overall if defined elsewhere... */
.ui-tabs .ui-tabs-panel { display: block; border-width: 0; padding: 1em 1.4em; background: none; }
.ui-tabs .ui-tabs-hide { display: none !important; }
/*
 * jQuery UI Datepicker 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Datepicker#theming
 */
.ui-datepicker { width: 17em; padding: .2em .2em 0; display: none; }
.ui-datepicker .ui-datepicker-header { position:relative; padding:.2em 0; }
.ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next { position:absolute; top: 2px; width: 1.8em; height: 1.8em; }
.ui-datepicker .ui-datepicker-prev-hover, .ui-datepicker .ui-datepicker-next-hover { top: 1px; }
.ui-datepicker .ui-datepicker-prev { left:2px; }
.ui-datepicker .ui-datepicker-next { right:2px; }
.ui-datepicker .ui-datepicker-prev-hover { left:1px; }
.ui-datepicker .ui-datepicker-next-hover { right:1px; }
.ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span { display: block; position: absolute; left: 50%; margin-left: -8px; top: 50%; margin-top: -8px;  }
.ui-datepicker .ui-datepicker-title { margin: 0 2.3em; line-height: 1.8em; text-align: center; }
.ui-datepicker .ui-datepicker-title select { font-size:1em; margin:1px 0; }
.ui-datepicker select.ui-datepicker-month-year {width: 100%;}
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 49%;}
.ui-datepicker table {width: 100%; font-size: .9em; border-collapse: collapse; margin:0 0 .4em; }
.ui-datepicker th { padding: .7em .3em; text-align: center; font-weight: bold; border: 0;  }
.ui-datepicker td { border: 0; padding: 1px; }
.ui-datepicker td span, .ui-datepicker td a { display: block; padding: .2em; text-align: right; text-decoration: none; }
.ui-datepicker .ui-datepicker-buttonpane { background-image: none; margin: .7em 0 0 0; padding:0 .2em; border-left: 0; border-right: 0; border-bottom: 0; }
.ui-datepicker .ui-datepicker-buttonpane button { float: right; margin: .5em .2em .4em; cursor: pointer; padding: .2em .6em .3em .6em; width:auto; overflow:visible; }
.ui-datepicker .ui-datepicker-buttonpane button.ui-datepicker-current { float:left; }

/* with multiple calendars */
.ui-datepicker.ui-datepicker-multi { width:auto; }
.ui-datepicker-multi .ui-datepicker-group { float:left; }
.ui-datepicker-multi .ui-datepicker-group table { width:95%; margin:0 auto .4em; }
.ui-datepicker-multi-2 .ui-datepicker-group { width:50%; }
.ui-datepicker-multi-3 .ui-datepicker-group { width:33.3%; }
.ui-datepicker-multi-4 .ui-datepicker-group { width:25%; }
.ui-datepicker-multi .ui-datepicker-group-last .ui-datepicker-header { border-left-width:0; }
.ui-datepicker-multi .ui-datepicker-group-middle .ui-datepicker-header { border-left-width:0; }
.ui-datepicker-multi .ui-datepicker-buttonpane { clear:left; }
.ui-datepicker-row-break { clear:both; width:100%; }

/* RTL support */
.ui-datepicker-rtl { direction: rtl; }
.ui-datepicker-rtl .ui-datepicker-prev { right: 2px; left: auto; }
.ui-datepicker-rtl .ui-datepicker-next { left: 2px; right: auto; }
.ui-datepicker-rtl .ui-datepicker-prev:hover { right: 1px; left: auto; }
.ui-datepicker-rtl .ui-datepicker-next:hover { left: 1px; right: auto; }
.ui-datepicker-rtl .ui-datepicker-buttonpane { clear:right; }
.ui-datepicker-rtl .ui-datepicker-buttonpane button { float: left; }
.ui-datepicker-rtl .ui-datepicker-buttonpane button.ui-datepicker-current { float:right; }
.ui-datepicker-rtl .ui-datepicker-group { float:right; }
.ui-datepicker-rtl .ui-datepicker-group-last .ui-datepicker-header { border-right-width:0; border-left-width:1px; }
.ui-datepicker-rtl .ui-datepicker-group-middle .ui-datepicker-header { border-right-width:0; border-left-width:1px; }

/* IE6 IFRAME FIX (taken from datepicker 1.5.3 */
.ui-datepicker-cover {
    display: none; /*sorry for IE5*/
    display/**/: block; /*sorry for IE5*/
    position: absolute; /*must have*/
    z-index: -1; /*must have*/
    filter: mask(); /*must have*/
    top: -4px; /*must have*/
    left: -4px; /*must have*/
    width: 200px; /*must have*/
    height: 200px; /*must have*/
}/*
 * jQuery UI Progressbar 1.8.8
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Progressbar#theming
 */
.ui-progressbar { height:2em; text-align: left; }
.ui-progressbar .ui-progressbar-value {margin: -1px; height:100%; }





.farbtastic {
  position: relative;
}
.farbtastic * {
  position: absolute;
  cursor: crosshair;
}
.farbtastic, .farbtastic .wheel {
  width: 195px;
  height: 195px;
}
.farbtastic .color, .farbtastic .overlay {
  top: 47px;
  left: 47px;
  width: 101px;
  height: 101px;
}
.farbtastic .wheel {
  background: url(" . $scriptServer . "wheel/wheel.png) no-repeat;
  width: 195px;
  height: 195px;
}
.farbtastic .overlay {
  background: url(" . $scriptServer . "wheel/mask.png) no-repeat;
}
.farbtastic .marker {
  width: 17px;
  height: 17px;
  margin: -8px 0 0 -8px;
  overflow: hidden; 
  background: url(" . $scriptServer . "wheel/marker.png) no-repeat;
}

#fboxLeft {
	width:198px;
	float:left;
	background-color: #ccc;
	border-right: 1px solid #999;
		-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	border-top: 1px solid #999;
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
		border-left: 1px solid #999;
	border-bottom: 1px solid #999;
}

#barRighter {
	width:194px;
	background-color: #fff;
	border-right: 1px solid #999;
	float:left;
}

#barRighter a{
	color: #333;
}

#barRighter .tabbed{
	background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
	border-bottom: 1px solid #999;
	padding:5px; font-size:14px;
}

#barRighter .tabbed:hover{
	background: url(" . $imgServer . "header/bkg_hov.png) repeat-x center top;
}

#barRighter .subTabbed{
	border-bottom: 1px solid #999;
	padding:5px; font-size:12px;
}

#barRighter .subTabbed:hover{
	background-color: " . $color . ";
	color: #fff;
}

#barRighter .tabbedBottom{
	border-bottom:none;
}

#fboxContent {
	width:700px;
	float:right;	
}
.fbHeadLeft {
		-moz-border-radius-bottomleft: 0px;
	-khtml-border-radius-bottomleft: 0px;
	-webkit-border-bottom-left-radius: 0px;

	-moz-border-radius-topleft: 0px;
	-khtml-border-radius-topleft: 0px;
	-webkit-border-top-left-radius: 0px;
	
	-moz-border-radius-bottomright: 0px;
	-khtml-border-radius-bottomright: 0px;
	-webkit-border-bottom-right-radius: 0px;
}
.fbHeadRight {
		-moz-border-radius-bottomright: 0px;
	-khtml-border-radius-bottomright: 0px;
	-webkit-border-bottom-right-radius: 0px;
}
#fbHead{
			font-size: 14px;
			font-weight: bolder;
			padding: 5px;
			border-top:1px solid #ccc;
			border-left:1px solid #c9c9c9;
			border-right:1px solid #c9c9c9;
			border-bottom:1px solid #999;
			background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
				/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;

		}
		#fbHead .fileName{
			width:300px;
		}
		#fbHead .fileType{
			width:135px;
			margin-right:5px;
			padding-left:5px;
			border-left:1px solid #999;
			float:right;
		}
		#fbHead .options{
			width:80px;
			margin-right:5px;
			padding-left:5px;
			border-left:1px solid #999;
			float:right;
		}
		#fbHead .createDate{
			width:145px;
			padding-left:5px;
			border-left:1px solid #999;
			float:right;
			text-align:right;
		}
		#selectable1{
			font-size: 12px;
		}
		#selectable1 li{
		 width:690px;
		 border-bottom: 1px solid #ccc;
		 list-style: none;
		 height:18px;
		}
		#selectable1 li .fileName{
			width:300px;
			float:left;
			position: absolute;
		}
		#selectable1 li .fileType{
			width:135px;
			margin-right:5px;
			color: #999;
			padding-left:5px;
			border-left:1px solid #ccc;
			left:305px;
			position: absolute;
		}
		#selectable1 li .options{
			width:80px;
			margin-right:5px;
			padding-left:5px;
			border-left:1px solid #ccc;
			text-align:center;
			left:453px;
			position: absolute;
		}
		#selectable1 li .createDate{
			width:150px;
			color: #999;
			border-left:1px solid #ccc;
			text-align:right;
			left:543px;
			position: absolute;
		}
		#selectable1 .ui-selecting {
			background: #ccc;
		}
		
		#selectable1 a small {  /*--panel tool tip styles--*/
	text-align: center;
	width: 70px;
	background: #333;
	padding: 2px 7px 2px 7px;
	display: none; /*--Hide by default--*/
	color: #fff;
	font-size: 1em;
	text-indent: 0;
	 /*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px; 
}
#selectable1 a:hover small {
	display: block; /*--Show on hover--*/
	position: absolute;
	top: -25px; /*--Position tooltip 35px above the list item--*/
	left: 50%;
	margin-left: -40px; /*--Center the tooltip--*/
	z-index: 9999;
}

		#selectable1 .ui-selected {
			background: $color;
			color:#fff;
			border-bottom: 1px solid #999;

		}
		#selectable1 .trans{
			filter:alpha(opacity=50);
        -moz-opacity:0.5;
        -khtml-opacity: 0.5;
        opacity: 0.5;
       }
		#selectable1 .ui-draggable{
			padding:5px;
		}
		#selectable1 .ui-draggable-dragging{
			font-color: #fff;		
		}













#fboxContent {
	width:700px;
	float:right;	
}
.fbHeadLeft {
		-moz-border-radius-bottomleft: 0px;
	-khtml-border-radius-bottomleft: 0px;
	-webkit-border-bottom-left-radius: 0px;

	-moz-border-radius-topleft: 0px;
	-khtml-border-radius-topleft: 0px;
	-webkit-border-top-left-radius: 0px;
	
	-moz-border-radius-bottomright: 0px;
	-khtml-border-radius-bottomright: 0px;
	-webkit-border-bottom-right-radius: 0px;
}
.fbHeadRight {
		-moz-border-radius-bottomright: 0px;
	-khtml-border-radius-bottomright: 0px;
	-webkit-border-bottom-right-radius: 0px;
}
#fbHead2{
			font-size: 14px;
			font-weight: bolder;
			padding: 5px;
			border-top:1px solid #ccc;
			border-left:1px solid #c9c9c9;
			border-right:1px solid #c9c9c9;
			border-bottom:1px solid #999;
			background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
				/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;

		}
		#fbHead2 .fileName{
			width:300px;
		}
		#fbHead2 .fileType{
			width:135px;
			margin-right:5px;
			padding-left:5px;
			border-left:1px solid #999;
			float:right;
		}
		#fbHead2 .options{
			width:80px;
			margin-right:5px;
			padding-left:5px;
			border-left:1px solid #999;
			float:right;
		}
		#fbHead2 .createDate{
			width:145px;
			padding-left:5px;
			border-left:1px solid #999;
			float:right;
			text-align:right;
		}
		#selectable2{
			font-size: 12px;
		}
		#selectable2 li{
		 width:742px;
		 border-bottom: 1px solid #ccc;
		 list-style: none;
		 height:18px;
		 padding:5px;
		}
		#selectable2 li .fileName{
			width:443px;
			float:left;
		}
		#selectable2 li .fileType{
			width:135px;
			margin-right:5px;
			color: #999;
			padding-left:5px;
			border-left:1px solid #ccc;
			float:left;
		}
		#selectable2 li .options{
			width:80px;
			margin-right:5px;
			padding-left:5px;
			border-left:1px solid #ccc;
			text-align:center;
			float:left;
		}
		#selectable2 li .createDate{
			width:150px;
			color: #999;
			border-left:1px solid #ccc;
			text-align:right;
			float:left;
		}









































div.jGrowl {
	padding: 			10px;
	z-index: 			9999;
	color: 				#fff;
	font-size: 			12px;
}

/** Special IE6 Style Positioning **/
div.ie6 {
	position: 			absolute;
}

div.ie6.top-right {
	right: 				auto;
	bottom: 			auto;
	left: 				expression( ( 0 - jGrowl.offsetWidth + ( document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth ) + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft ) ) + 'px' );
  	top: 				expression( ( 0 + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ) ) + 'px' );
}

div.ie6.top-left {
	left: 				expression( ( 0 + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft ) ) + 'px' );
	top: 				expression( ( 0 + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ) ) + 'px' );
}

div.ie6.bottom-right {
	left: 				expression( ( 0 - jGrowl.offsetWidth + ( document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth ) + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft ) ) + 'px' );
	top: 				expression( ( 0 - jGrowl.offsetHeight + ( document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight ) + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ) ) + 'px' );
}

div.ie6.bottom-left {
	left: 				expression( ( 0 + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft ) ) + 'px' );
	top: 				expression( ( 0 - jGrowl.offsetHeight + ( document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight ) + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ) ) + 'px' );
}

div.ie6.center {
	left: 				expression( ( 0 + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft ) ) + 'px' );
	top: 				expression( ( 0 + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ) ) + 'px' );
	width: 				100%;
}

/** Normal Style Positions **/
div.jGrowl {
	position:			absolute;
}

body > div.jGrowl {
	position:			fixed;
}

div.jGrowl.top-left {
	left: 				0px;
	top: 				0px;
}

div.jGrowl.top-right {
	right: 				0px;
	top: 				0px;
}

div.jGrowl.bottom-left {
	left: 				0px;
	bottom:				0px;
}

div.jGrowl.bottom-right {
	right: 				25px;
	bottom: 			20px;
}

div.jGrowl.center {
	top: 				0px;
	width: 				50%;
	left: 				25%;
}

/** Cross Browser Styling **/
div.center div.jGrowl-notification, div.center div.jGrowl-closer {
	margin-left: 		auto;
	margin-right: 		auto;
}

div.jGrowl div.jGrowl-notification, div.jGrowl div.jGrowl-closer {
	background-color: 		#000;
	opacity: 				.85;
    -ms-filter: 			\"progid:DXImageTransform.Microsoft.Alpha(Opacity=85)\"; 
    filter: 				progid:DXImageTransform.Microsoft.Alpha(Opacity=85); 
	zoom: 					1;
	width: 					235px;
	padding: 				10px;
	margin-top: 			5px;
	margin-bottom: 			5px;
	font-family: 			Tahoma, Arial, Helvetica, sans-serif;
	font-size: 				1em;
	text-align: 			left;
	display: 				none;
	-moz-border-radius: 	5px;
	-webkit-border-radius:	5px;
}

div.jGrowl div.jGrowl-notification {
	min-height: 			40px;
}

div.jGrowl div.jGrowl-notification a{
	color: " . $color . ";
}

div.jGrowl div.jGrowl-notification div.jGrowl-header {
	font-weight: 			bold;
	font-size:				.85em;
}

div.jGrowl div.jGrowl-notification div.jGrowl-close {
	z-index:				99;
	float: 					right;
	font-weight: 			bold;
	font-size: 				1em;
	cursor:					pointer;
}

div.jGrowl div.jGrowl-closer {
	padding-top: 			4px;
	padding-bottom: 		4px;
	cursor: 				pointer;
	font-size:				.9em;
	font-weight: 			bold;
	text-align: 			center;
	background: #000000;
	border: 1px solid #999;
}

/** Hide jGrowl when printing **/
@media print {
	div.jGrowl {
		display: 			none;
	}
}




.hudFileList {
	border-bottom:1px solid #999;
	font-size: 14px;
	list-style:none;
}

.noRound {
	-moz-border-radius: 0px;
	-khtml-border-radius: 0px;
	-webkit-border-radius: 0px; 
	font-size:12px;
}


.fullRound {
	-moz-border-radius: 5px;
	-khtml-border-radius: 5px;
	-webkit-border-radius: 5px; 
}

















.fc,
.fc .fc-header,
.fc .fc-content {
	font-size: 1em;
	}
	
.fc {
	direction: ltr;
	text-align: left;
	}
	
.fc table {
	border-collapse: collapse;
	border-spacing: 0;
	}
	
.fc td, .fc th {
	padding: 0;
	vertical-align: top;
	}



/* Header
------------------------------------------------------------------------*/
	
table.fc-header {
	width: 100%;
	}
	
.fc-header-left {
	width: 25%;
	}
	
.fc-header-left table {
	float: left;
	}
	
.fc-header-center {
	width: 50%;
	text-align: center;
	}
	
.fc-header-center table {
	margin: 0 auto;
	}
	
.fc-header-right {
	width: 25%;
	}
	
.fc-header-right table {
	float: right;
	}
	
.fc-header-title {
	margin-top: 0;
	white-space: nowrap;
	}
	
.fc-header-space {
	padding-left: 10px;
	}
	
/* right-to-left */

.fc-rtl .fc-header-title {
	direction: rtl;
	}



/* Buttons
------------------------------------------------------------------------*/

.fc-header .fc-state-default,
.fc-header .ui-state-default {
	margin-bottom: 1em;
	cursor: pointer;
	}
	
.fc-header .fc-state-default {
	border-width: 1px 0;
	padding: 0 1px;
	}
	
.fc-header .fc-state-default,
.fc-header .fc-state-default a {
	border-style: solid;
	}
	
.fc-header .fc-state-default a {
	display: block;
	border-width: 0 1px;
	margin: 0 -1px;
	width: 100%;
	text-decoration: none;
	}
	
.fc-header .fc-state-default span {
	display: block;
	border-style: solid;
	border-width: 1px 0 1px 1px;
	padding: 3px 5px;
	}
	
.fc-header .ui-state-default {
	padding: 4px 6px;
	}
	
.fc-header .fc-state-default span,
.fc-header .ui-state-default span {
	white-space: nowrap;
	}
	
/* for adjacent buttons */
	
.fc-header .fc-no-right {
	padding-right: 0;
	}
	
.fc-header .fc-no-right a {
	margin-right: 0;
	border-right: 0;
	}
	
.fc-header .ui-no-right {
	border-right: 0;
	}
	
/* for fake rounded corners */
	
.fc-header .fc-corner-left {
	margin-left: 1px;
	padding-left: 0;
	}
	
.fc-header .fc-corner-right {
	margin-right: 1px;
	padding-right: 0;
	}
	
/* DEFAULT button COLORS */
	
.fc-header .fc-state-default,
.fc-header .fc-state-default a {
	border-color: #777; /* outer border */
	color: #333;
	}

.fc-header .fc-state-default span {
	border-color: #fff #fff #d1d1d1; /* inner border */
	background: #e8e8e8;
	}
	
/* PRESSED button COLORS (down and active) */
	
.fc-header .fc-state-active a {
	color: #fff;
	}
	
.fc-header .fc-state-down span,
.fc-header .fc-state-active span {
	background: #888;
	border-color: #808080 #808080 #909090; /* inner border */
	}
	
/* DISABLED button COLORS */
	
.fc-header .fc-state-disabled a {
	color: #999;
	}
	
.fc-header .fc-state-disabled,
.fc-header .fc-state-disabled a {
	border-color: #ccc; /* outer border */
	}
	
.fc-header .fc-state-disabled span {
	border-color: #fff #fff #f0f0f0; /* inner border */
	background: #f0f0f0;
	}
	
	
	
/* Content Area & Global Cell Styles
------------------------------------------------------------------------*/
	
.fc-widget-content {
	border: 1px solid #ccc; /* outer border color */
	}
	
.fc-content {
	clear: both;
	}
	
.fc-content .fc-state-default {
	border-style: solid;
	border-color: #ccc; /* inner border color */
	}
	
.fc-content .fc-state-highlight { /* today */
	background: #ffc;
	}
	
.fc-content .fc-not-today { /* override jq-ui highlight (TODO: ui-widget-content) */
	background: none;
	}
	
.fc-cell-overlay { /* semi-transparent rectangle while dragging */
	background: #9cf;
	opacity: .2;
	filter: alpha(opacity=20); /* for IE */
	}
	
.fc-view { /* prevents dragging outside of widget */
	width: 100%;
	overflow: hidden;
	}
	
	
	


/* Global Event Styles
------------------------------------------------------------------------*/

.fc-event,
.fc-agenda .fc-event-time,
.fc-event a {
	border-style: solid; 
	border-color: #666;     /* default BORDER color (probably the same as background-color) */
	background-color: " . $color . "; /* default BACKGROUND color */
	color: #fff;            /* default TEXT color */
	}
	
	/* Use the 'className' CalEvent property and the following
	 * example CSS to change event color on a per-event basis:
	 *
	 * .myclass,
	 * .fc-agenda .myclass .fc-event-time,
	 * .myclass a {
	 *     background-color: black;
	 *     border-color: black;
	 *     color: red;
	 *     }
	 */
	 
.fc-event {
	text-align: left;
	}
	
.fc-event a {
	overflow: hidden;
	font-size: .85em;
	text-decoration: none;
	cursor: pointer;
	}
	
.fc-event-editable {
	cursor: pointer;
	}
	
.fc-event-time,
.fc-event-title {
	padding: 0 1px;
	}
	
/* for fake rounded corners */

.fc-event a {
	display: block;
	position: relative;
	width: 100%;
	height: 100%;
	}
	
/* right-to-left */

.fc-rtl .fc-event a {
	text-align: right;
	}
	
/* resizable */
	
.fc .ui-resizable-handle { /*** TODO: don't use ui-resizable anoymore, change class ***/
	display: block;
	position: absolute;
	z-index: 99999;
	border: 0 !important; /* important overrides pre jquery ui 1.7 styles */
	background: url(data:image/gif;base64,AAAA) !important; /* hover fix for IE */
	}
	
	
	
/* Horizontal Events
------------------------------------------------------------------------*/

.fc-event-hori {
	border-width: 1px 0;
	margin-bottom: 1px;
	}
	
.fc-event-hori a {
	border-width: 0;
	}
	
/* for fake rounded corners */
	
.fc-content .fc-corner-left {
	margin-left: 1px;
	}
	
.fc-content .fc-corner-left a {
	margin-left: -1px;
	border-left-width: 1px;
	}
	
.fc-content .fc-corner-right {
	margin-right: 1px;
	}
	
.fc-content .fc-corner-right a {
	margin-right: -1px;
	border-right-width: 1px;
	}
	
/* resizable */
	
.fc-event-hori .ui-resizable-e {
	top: 0           !important; /* importants override pre jquery ui 1.7 styles */
	right: -3px      !important;
	width: 7px       !important;
	height: 100%     !important;
	cursor: e-resize;
	}
	
.fc-event-hori .ui-resizable-w {
	top: 0           !important;
	left: -3px       !important;
	width: 7px       !important;
	height: 100%     !important;
	cursor: w-resize;
	}
	
.fc-event-hori .ui-resizable-handle {
	_padding-bottom: 14px; /* IE6 had 0 height */
	}
	
	
	

/* Month View, Basic Week View, Basic Day View
------------------------------------------------------------------------*/

.fc-grid table {
	width: 100%;
	}
	
.fc .fc-grid th {
	border-width: 0 0 0 1px;
	text-align: center;
	}
	
.fc .fc-grid td {
	border-width: 1px 0 0 1px;
	}
	
.fc-grid th.fc-leftmost,
.fc-grid td.fc-leftmost {
	border-left: 0;
	}
	
.fc-grid .fc-day-number {
	float: right;
	padding: 0 2px;
	}
	
.fc-grid .fc-other-month .fc-day-number {
	opacity: 0.3;
	filter: alpha(opacity=30); /* for IE */
	/* opacity with small font can sometimes look too faded
	   might want to set the 'color' property instead
	   making day-numbers bold also fixes the problem */
	}
	
.fc-grid .fc-day-content {
	clear: both;
	padding: 2px 2px 0; /* distance between events and day edges */
	}
	
/* event styles */
	
.fc-grid .fc-event-time {
	font-weight: bold;
	}
	
/* right-to-left */

.fc-rtl .fc-grid {
	direction: rtl;
	}
	
.fc-rtl .fc-grid .fc-day-number {
	float: left;
	}
	
.fc-rtl .fc-grid .fc-event-time {
	float: right;
	}
	
/* Agenda Week View, Agenda Day View
------------------------------------------------------------------------*/

.fc .fc-agenda th,
.fc .fc-agenda td {
	border-width: 1px 0 0 1px;
	}
	
.fc .fc-agenda .fc-leftmost {
	border-left: 0;
	}
	
.fc-agenda tr.fc-first th,
.fc-agenda tr.fc-first td {
	border-top: 0;
	}
	
.fc-agenda-head tr.fc-last th {
	border-bottom-width: 1px;
	}
	
.fc .fc-agenda-head td,
.fc .fc-agenda-body td {
	background: none;
	}
	
.fc-agenda-head th {
	text-align: center;
	}
	
/* the time axis running down the left side */
	
.fc-agenda .fc-axis {
	width: 50px;
	padding: 0 4px;
	vertical-align: middle;
	white-space: nowrap;
	text-align: right;
	font-weight: normal;
	}
	
/* all-day event cells at top */
	
.fc-agenda-head tr.fc-all-day th {
	height: 35px;
	}
	
.fc-agenda-head td {
	padding-bottom: 10px;
	}
	
.fc .fc-divider div {
	font-size: 1px; /* for IE6/7 */
	height: 2px;
	}
	
.fc .fc-divider .fc-state-default {
	background: #eee; /* color for divider between all-day and time-slot events */
	}

/* body styles */
	
.fc .fc-agenda-body td div {
	height: 20px; /* slot height */
	}
	
.fc .fc-agenda-body tr.fc-minor th,
.fc .fc-agenda-body tr.fc-minor td {
	border-top-style: dotted;
	}
	
.fc-agenda .fc-day-content {
	padding: 2px 2px 0; /* distance between events and day edges */
	}
	
/* vertical background columns */

.fc .fc-agenda-bg .ui-state-highlight {
	background-image: none; /* tall column, don't want repeating background image */
	}
	


/* Vertical Events
------------------------------------------------------------------------*/

.fc-event-vert {
	border-width: 0 1px;
	}
	
.fc-event-vert a {
	border-width: 0;
	}
	
/* for fake rounded corners */
	
.fc-content .fc-corner-top {
	margin-top: 1px;
	}
	
.fc-content .fc-corner-top a {
	margin-top: -1px;
	border-top-width: 1px;
	}
	
.fc-content .fc-corner-bottom {
	margin-bottom: 1px;
	}
	
.fc-content .fc-corner-bottom a {
	margin-bottom: -1px;
	border-bottom-width: 1px;
	}
	
/* event content */
	
.fc-event-vert span {
	display: block;
	position: relative;
	z-index: 2;
	}
	
.fc-event-vert span.fc-event-time {
	white-space: nowrap;
	_white-space: normal;
	overflow: hidden;
	border: 0;
	font-size: 10px;
	}
	
.fc-event-vert span.fc-event-title {
	line-height: 13px;
	}
	
.fc-event-vert span.fc-event-bg { /* makes the event lighter w/ a semi-transparent overlay  */
	position: absolute;
	z-index: 1;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: #fff;
	opacity: .3;
	filter: alpha(opacity=30); /* for IE */
	}
	
/* resizable */
	
.fc-event-vert .ui-resizable-s {
	bottom: 0        !important; /* importants override pre jquery ui 1.7 styles */
	width: 100%      !important;
	height: 8px      !important;
	line-height: 8px !important;
	font-size: 11px  !important;
	font-family: monospace;
	text-align: center;
	cursor: s-resize;
	}
	







.boxSearch {
	float:left;
	background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
	font-size:16px;
	width:180px;
	height: 33px;
	border: 1px solid #999999;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 0px;
	-khtml-border-radius-bottomleft: 0px;
	-webkit-border-bottom-left-radius: 0px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 0px;
	-khtml-border-radius-topleft: 0px;
	-webkit-border-top-left-radius: 0px;
	outline: none;
}
input.boxInput {
	float:left;
	width:710px;
	font-size:16px;
	padding-top:6px;
	padding-bottom:6px;
	border: 1px solid #999999;
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 0px;
	-khtml-border-radius-topleft: 0px;
	-webkit-border-top-left-radius: 0px;
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomright: 0px;
	-khtml-border-radius-bottomright: 0px;
	-webkit-border-bottom-right-radius: 0px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topright: 0px;
	-khtml-border-radius-topright: 0px;
	-webkit-border-top-right-radius: 0px;
	outline: none;
}


.sboxLeft {
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 0px;
	-khtml-border-radius-bottomleft: 0px;
	-webkit-border-bottom-left-radius: 0px;
	
}
.sboxRight {
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomright: 0px;
	-khtml-border-radius-bottomright: 0px;
	-webkit-border-bottom-right-radius: 0px;
}


#resultBox {
	float:left;
	padding-bottom:10px;
	padding-top:10px;
	border-bottom: 2px solid #CCCCCC;
	width:900px;	
}

#resultBox .title{
	font-weight:bolder;
	font-size:14px;
}


#resultBox .desc{
	padding-left:4px;
	border-left: 1px solid #CCCCCC;
}

#resultBox .url{
	color:#999;
	font-style: italic;
}

#noresultBox {
	margin-left:300px;
	margin-top:100px;
}

#noresultBox .title{
	font-size:14px;
	font-weight:bolder;
}

#noresultBox .desc{
	font-size:12px;
	color: #999;
}

.classimg {
	width: 128px;
	height: 128px;
	float:left;
}

.iconFloater {
	float:right;
	padding-left:5px;
	padding-right:5px;
	padding-top:2px;
	padding-bottom:2px;
	background: #000;
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	display:none;
}

.iconFloater a{
	color: #999;
}

.iconFloater a:hover{
	color: #fff;
	text-decoration: underline;
}

#forumEl a small {  /*--panel tool tip styles--*/
	text-align: center;
	width: 40px;
	background: #333;
	padding: 2px 7px 2px 7px;
	display: none; /*--Hide by default--*/
	color: #fff;
	font-size: 11px;
	text-indent: 0;
	 /*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px; 
}
#forumEl a:hover small {
	display: block; /*--Show on hover--*/
	position:absolute;
	margin-top:-4px;
	margin-left:15px;
	z-index: 9999;
}

.showRep {
		/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
		 /*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
border-left: 1px solid #ccc;	
border-right: 1px solid #ccc;	
border-bottom: 1px solid #ccc;	
background: #ececec;
float:right;
display:none;
margin-top:-1px;
width:70px;
margin-right:10px;
padding-left:4px;
font-size:13px;
}

.showDel {
		/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
		 /*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
border-left: 1px solid #ccc;	
border-right: 1px solid #ccc;	
border-bottom: 1px solid #ccc;	
background: #ececec;
float:right;
display:none;
margin-top:-1px;
width:70px;
margin-right:90px;
padding-left:4px;
font-size:13px;
}


.testEvent,
.fc-agenda .testEvent .fc-event-time,
.testEvent a {
    background: #fa0000 url(" . $imgServer . "main/cal_rep.png) repeat-x; /* background color */
}
 
 
.projEvent,
.fc-agenda .projEvent .fc-event-time,
.projEvent a {
    background: #fad500 url(" . $imgServer . "main/cal_rep.png) repeat-x; /* background color */
}
    
    
.eventEvent,
.fc-agenda .eventEvent .fc-event-time,
.eventEvent a {
    background: #0d00fa url(" . $imgServer . "main/cal_rep.png) repeat-x; /* background color */
}   
 

.asmtEvent,
.fc-agenda .asmtEvent .fc-event-time,
.asmtEvent a {
    background: #2dad00 url(" . $imgServer . "main/cal_rep.png) repeat-x; /* background color */
}













/* TextboxList sample CSS */
ul.holder { margin: 0; border: 1px solid #999; overflow: hidden; height: auto !important; height: 1%; padding: 4px 5px 0; }
*:first-child+html ul.holder { padding-bottom: 2px; } * html ul.holder { padding-bottom: 2px; } /* ie7 and below */
ul.holder li { float: left; list-style-type: none; margin: 0 5px 4px 0; white-space:nowrap;}
ul.holder li.bit-box, ul.holder li.bit-input input { font: 11px; }
ul.holder li.bit-box { -moz-border-radius: 6px; -webkit-border-radius: 6px; border-radius: 6px; border: 1px solid #ccc; background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x; padding: 1px 5px 2px; }
ul.holder li.bit-box-focus { border-color: #598BEC; background: #598BEC; color: #fff; }
ul.holder li.bit-input input { width: auto; overflow:visible; margin: 0; border: 0px; outline: 0; padding: 3px 0px 2px; } /* no left/right padding here please */
ul.holder li.bit-input input.smallinput { width: 20px; }

/* Facebook demo CSS */
ul.holder { width: 500px; }
ul.holder { margin: 0 !important }
ul.holder li.bit-box, #apple-list ul.holder li.bit-box { padding-right: 15px; position: relative; z-index:1000;}
#apple-list ul.holder li.bit-input { margin: 0; }
#apple-list ul.holder li.bit-input input.smallinput { width: 5px; }
ul.holder li.bit-hover { background: #BBCEF1; border: 1px solid #6D95E0; }
ul.holder li.bit-box-focus { border-color: #598BEC; background: #598BEC; color: #fff; }
ul.holder li.bit-box a.closebutton { position: absolute; right: 4px; top: 5px; display: block; width: 7px; height: 7px; font-size: 1px; background: url('" . $imgServer . "gen/close.gif'); }
ul.holder li.bit-box a.closebutton:hover { background-position: 7px; }
ul.holder li.bit-box-focus a.closebutton, ul.holder li.bit-box-focus a.closebutton:hover { background-position: bottom; }

/* Autocompleter */

.facebook-auto { display: none; position: absolute; width: 512px; background: #eee; z-index:1001;}
.facebook-auto .default { padding: 5px 7px; border: 1px solid #ccc; border-width: 0 1px 1px; font-size:11px; }
.facebook-auto ul { display: none; margin: 0; padding: 0; overflow: auto; position:absolute; z-index:9999}
.facebook-auto ul li { padding: 5px 12px; z-index: 1000; cursor: pointer; margin: 0; list-style-type: none; border: 1px solid #ccc; border-width: 0 1px 1px; font: 11px; background-color: #eee }
.facebook-auto ul li em { font-weight: bold; font-style: normal; background: #ccc; }
.facebook-auto ul li.auto-focus { background: " . $color . "; color: #fff; }
.facebook-auto ul li.auto-focus em { background: none; }
.deleted { background-color:#4173CC !important; color:#ccc !important;}
.hidden { display:none;}

#demo ul.holder li.bit-input input { padding: 2px 0 1px; border: 1px solid #999; }
.ie6fix {height:1px;width:1px; position:absolute;top:0px;left:0px;z-index:1;}


.subjecter {
	-moz-border-radius: 0px;
	-khtml-border-radius: 0px;
	-webkit-border-radius: 0px;
           padding:6px;
           width:499px;
}


#inboxmain .comment_load {
	color: #333;
	background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
	list-style:none;
		height:40px;
		-moz-border-radius: 5px;
	-khtml-border-radius: 5px;
	-webkit-border-radius: 5px;
	border: 1px solid #999;
}
#inboxmain .comment_load_text {
	color: #333;
	font-size:16px;
	padding-top:8px;
	text-align:center;
}
#inboxmain .comment_load:hover {
	background: #CCC url(" . $imgServer . "header/bkg_hov.png) repeat-x;

}

.bevColor {
background: " . $color . " url(" . $imgServer . "main/sub_rep.png) repeat-x;
}

.bevColor a{
    color: #fff;
}

.borderColor {
border-bottom: 4px solid " . $color . ";
}


#home-left {
width:200px;
height:500px;
border-right:1px solid #cdcdc9;
float:left;
}

#home-left h1{
background-color: #f7f7f4;
border-bottom:1px solid #cdcdc9;
margin: 0;
padding-top:3px;
padding-bottom:3px;
padding-left:10px;
}

#home-main {
width:450px;
float:left;
margin-left: 25px;
}

#home-main .head{
margin-bottom:15px;
font-size:14px;
color:#666;
border-bottom:1px solid #cdcdc9;
font-weight:bolder;
}

#home-main #agenda{
width:450px;
border-collapse:collapse;
}

#home-main #agenda th{
border-left:1px solid #cdcdc9;
color: #666;
padding:3px;
font-weight:bolder;
}

#home-main #agenda td{
border-top:1px solid #cdcdc9;
border-left:1px solid #cdcdc9;

}

#home-main #agenda a{
color:#fff
}

#home-main #agenda a:hover{
color:#fff
}


#home-right {
width:200px;
height:500px;
border-left:1px solid #cdcdc9;
float:right;
overflow-x:hidden;
}

#home-right h1{
background-color: #f7f7f4;
border-bottom:1px solid #cdcdc9;
margin: 0;
padding-top:3px;
padding-bottom:3px;
padding-left:10px;
}


/* Fluid class for determining actual width in IE */
.ui-tooltip-fluid{
	display: block;
	visibility: hidden;
	position: static !important;
	float: left !important;
}

.ui-tooltip, .qtip{
	position: absolute;
	left: -28000px;
	top: -28000px;
	display: none;

	max-width: 280px;
	min-width: 50px;

	font-size: 10.5px;
	line-height: 12px;
}

	.ui-tooltip-content{
		position: relative;
		padding: 5px 9px;
		overflow: hidden;

		border-width: 1px;
		border-style: solid;

		text-align: left;
		word-wrap: break-word;
		overflow: hidden;
	}

	.ui-tooltip-titlebar{
		position: relative;
		min-height: 14px;
		padding: 5px 35px 5px 10px;
		overflow: hidden;

		border-width: 1px 1px 0;
		border-style: solid;

		font-weight: bold;
	}

	.ui-tooltip-titlebar + .ui-tooltip-content{ border-top-width: 0px !important; }

		/*! Default close button class */
		.ui-tooltip-titlebar .ui-state-default{
			position: absolute;
			right: 4px;
			top: 50%;
			margin-top: -9px;

			cursor: pointer;
			outline: medium none;

			border-width: 1px;
			border-style: solid;
		}

		* html .ui-tooltip-titlebar .ui-state-default{
			top: 16px;
		}

		.ui-tooltip-titlebar .ui-icon,
		.ui-tooltip-icon .ui-icon{
			display: block;
			text-indent: -1000em;
		}

		.ui-tooltip-icon, .ui-tooltip-icon .ui-icon{
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			border-radius: 3px;
		}

			.ui-tooltip-icon .ui-icon{
				width: 18px;
				height: 14px;

				text-align: center;
				text-indent: 0;
				font: normal bold 10px/13px Tahoma,sans-serif;

				color: inherit;
				background: transparent none no-repeat -100em -100em;
			}


/* Applied to 'focused' tooltips e.g. most recently displayed/interacted with */
.ui-tooltip-focus{

}


/*! Default tooltip style */
.ui-tooltip-titlebar,
.ui-tooltip-content{
	border-color: #F1D031;
	background-color: #FFFFA3;
	color: #555;
}

	.ui-tooltip-titlebar{
		background-color: #FFEF93;
	}

	.ui-tooltip-titlebar .ui-tooltip-icon{
		border-color: #CCC;
		background: #F1F1F1;
		color: #777;
	}

	.ui-tooltip-titlebar .ui-state-hover{
		border-color: #AAA;
		color: #111;
	}


/*! Light tooltip style */
.ui-tooltip-light .ui-tooltip-titlebar,
.ui-tooltip-light .ui-tooltip-content{
	border-color: #E2E2E2;
	color: #454545;
}

	.ui-tooltip-light .ui-tooltip-content{
		background-color: white;
	}

	.ui-tooltip-light .ui-tooltip-titlebar{
		background-color: #f1f1f1;
	}


/*! Dark tooltip style */
.ui-tooltip-dark .ui-tooltip-titlebar,
.ui-tooltip-dark .ui-tooltip-content{
	border-color: #303030;
	color: #f3f3f3;
}

	.ui-tooltip-dark .ui-tooltip-content{
		background-color: #505050;
	}

	.ui-tooltip-dark .ui-tooltip-titlebar{
		background-color: #404040;
	}

	.ui-tooltip-dark .ui-tooltip-icon{
		border-color: #444;
	}

	.ui-tooltip-dark .ui-tooltip-titlebar .ui-state-hover{
		border-color: #303030;
	}


/*! Cream tooltip style */
.ui-tooltip-cream .ui-tooltip-titlebar,
.ui-tooltip-cream .ui-tooltip-content{
	border-color: #F9E98E;
	color: #A27D35;
}

	.ui-tooltip-cream .ui-tooltip-content{
		background-color: #FBF7AA;
	}

	.ui-tooltip-cream .ui-tooltip-titlebar{
		background-color: #F0DE7D;
	}

	.ui-tooltip-cream .ui-state-default .ui-tooltip-icon{
		background-position: -82px 0;
	}


/*! Red tooltip style */
.ui-tooltip-red .ui-tooltip-titlebar,
.ui-tooltip-red .ui-tooltip-content{
	border-color: #D95252;
	color: #912323;
}

	.ui-tooltip-red .ui-tooltip-content{
		background-color: #F78B83;
	}

	.ui-tooltip-red .ui-tooltip-titlebar{
		background-color: #F06D65;
	}

	.ui-tooltip-red .ui-state-default .ui-tooltip-icon{
		background-position: -102px 0;
	}

	.ui-tooltip-red .ui-tooltip-icon{
		border-color: #D95252;
	}

	.ui-tooltip-red .ui-tooltip-titlebar .ui-state-hover{
		border-color: #D95252;
	}


/*! Green tooltip style */
.ui-tooltip-green .ui-tooltip-titlebar,
.ui-tooltip-green .ui-tooltip-content{
	border-color: #90D93F;
	color: #3F6219;
}

	.ui-tooltip-green .ui-tooltip-content{
		background-color: #CAED9E;
	}

	.ui-tooltip-green .ui-tooltip-titlebar{
		background-color: #B0DE78;
	}

	.ui-tooltip-green .ui-state-default .ui-tooltip-icon{
		background-position: -42px 0;
	}


/*! Blue tooltip style */
.ui-tooltip-blue .ui-tooltip-titlebar,
.ui-tooltip-blue .ui-tooltip-content{
	border-color: #ADD9ED;
	color: #5E99BD;
}

	.ui-tooltip-blue .ui-tooltip-content{
		background-color: #E5F6FE;
	}

	.ui-tooltip-blue .ui-tooltip-titlebar{
		background-color: #D0E9F5;
	}

	.ui-tooltip-blue .ui-state-default .ui-tooltip-icon{
		background-position: -2px 0;
	}.ui-tooltip .ui-tooltip-tip{
	margin: 0 auto;
	overflow: hidden;

	background: transparent !important;
	border: 0px dashed transparent !important;
	z-index: 10;
}

	.ui-tooltip .ui-tooltip-tip,
	.ui-tooltip .ui-tooltip-tip *{
		position: absolute;

		line-height: 0.1px !important;
		font-size: 0.1px !important;
		color: #123456;

		background: transparent;
		border: 0px dashed transparent;
	}

	.ui-tooltip .ui-tooltip-tip canvas{ position: static; }#qtip-overlay{
	position: absolute;
	left: -10000em;
	top: -10000em;

	background-color: black;

	opacity: 0.7;
	filter:alpha(opacity=70);
	-ms-filter:\"progid:DXImageTransform.Microsoft.Alpha(Opacity=70)\";
}

/*! Add shadows to your tooltips in: FF3+, Chrome 2+, Opera 10.6+, IE6+, Safari 2+ */
.ui-tooltip-shadow{
	-webkit-box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, 0.15);
	-moz-box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, 0.15);
	box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, 0.15);
}

	.ui-tooltip-shadow .ui-tooltip-titlebar,
	.ui-tooltip-shadow .ui-tooltip-content{
		filter: progid:DXImageTransform.Microsoft.Shadow(Color='gray', Direction=135, Strength=3);
		-ms-filter:\"progid:DXImageTransform.Microsoft.Shadow(Color='gray', Direction=135, Strength=3)\";
	}


/*! Add rounded corners to your tooltips in: FF3+, Chrome 2+, Opera 10.6+, IE9+, Safari 2+ */
.ui-tooltip-rounded,
.ui-tooltip-rounded .ui-tooltip-content,
.ui-tooltip-tipsy,
.ui-tooltip-tipsy .ui-tooltip-content,
.ui-tooltip-youtube,
.ui-tooltip-youtube .ui-tooltip-content{
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
}

.ui-tooltip-rounded .ui-tooltip-titlebar,
.ui-tooltip-tipsy .ui-tooltip-titlebar,
.ui-tooltip-youtube .ui-tooltip-titlebar{
	-moz-border-radius: 5px 5px 0 0;
	-webkit-border-radius: 5px 5px 0 0;
	border-radius: 5px 5px 0 0;
}

.ui-tooltip-rounded .ui-tooltip-titlebar + .ui-tooltip-content,
.ui-tooltip-tipsy .ui-tooltip-titlebar + .ui-tooltip-content,
.ui-tooltip-youtube .ui-tooltip-titlebar + .ui-tooltip-content{
	-moz-border-radius: 0 0 5px 5px;
	-webkit-border-radius: 0 0 5px 5px;
	border-radius: 0 0 5px 5px;
}


/*! Youtube tooltip style */
.ui-tooltip-youtube{
	-webkit-box-shadow: 0 0 3px #333;
	-moz-box-shadow: 0 0 3px #333;
	box-shadow: 0 0 3px #333;
}

	.ui-tooltip-youtube .ui-tooltip-titlebar,
	.ui-tooltip-youtube .ui-tooltip-content{
		background: transparent;
		background: rgba(0, 0, 0, 0.85);
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#D9000000,endColorstr=#D9000000);
		-ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorstr=#D9000000,endColorstr=#D9000000)\";

		color: white;
		border-color: #CCCCCC;
	}

	.ui-tooltip-youtube .ui-tooltip-icon{
		border-color: #222;
	}

	.ui-tooltip-youtube .ui-tooltip-titlebar .ui-state-hover{
		border-color: #303030;
	}


/* jQuery TOOLS Tooltip style */
.ui-tooltip-jtools{
	background: #232323;
	background: rgba(0, 0, 0, 0.7);
	background-image: -moz-linear-gradient(top, #717171, #232323);
	background-image: -webkit-gradient(linear, left top, left bottom, from(#717171), to(#232323));

	border: 2px solid #ddd;
	border: 2px solid rgba(241,241,241,1);

	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;

	-webkit-box-shadow: 0 0 12px #333;
	-moz-box-shadow: 0 0 12px #333;
	box-shadow: 0 0 12px #333;
}
	/* IE Specific */
	.ui-tooltip-jtools .ui-tooltip-titlebar{
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#717171,endColorstr=#4A4A4A);
		-ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorstr=#717171,endColorstr=#4A4A4A)\";
	}

	.ui-tooltip-jtools .ui-tooltip-content{
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#4A4A4A,endColorstr=#232323);
		-ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorstr=#4A4A4A,endColorstr=#232323)\";
	}

	.ui-tooltip-jtools .ui-tooltip-titlebar,
	.ui-tooltip-jtools .ui-tooltip-content{
		background: transparent;
		color: white;
		border: 0 dashed transparent;
	}

	.ui-tooltip-jtools .ui-tooltip-icon{
		border-color: #555;
	}

	.ui-tooltip-jtools .ui-tooltip-titlebar .ui-state-hover{
		border-color: #333;
	}


/* Cluetip style */
.ui-tooltip-cluetip{
	-webkit-box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.4);
	-moz-box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.4);
	box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.4);
}

	.ui-tooltip-cluetip .ui-tooltip-titlebar{
		background-color: #87876A;
		color: white;
		border: 0 dashed transparent;
	}

	.ui-tooltip-cluetip .ui-tooltip-content{
		background-color: #D9D9C2;
		color: #111;
		border: 0 dashed transparent;
	}

	.ui-tooltip-cluetip .ui-tooltip-icon{
		border-color: #808064;
	}

	.ui-tooltip-cluetip .ui-tooltip-titlebar .ui-state-hover{
		border-color: #696952;
		color: #696952;
	}


/* Tipsy style */
.ui-tooltip-tipsy{
	border: 0 solid #000;
	border: 0 solid rgba(0,0,0,.87);
}

	.ui-tooltip-tipsy .ui-tooltip-titlebar,
	.ui-tooltip-tipsy .ui-tooltip-content{
		background: transparent;
		background: rgba(0, 0, 0, .87);
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#D9000000,endColorstr=#D9000000);
		-ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorstr=#D9000000,endColorstr=#D9000000)\";

		color: white;
		border: 0 dashed transparent;

		font-size: 11px;
		font-family: 'Lucida Grande', sans-serif;
		font-weight: bold;
		line-height: 16px;
		text-shadow: 0 1px black;
	}

	.ui-tooltip-tipsy .ui-tooltip-titlebar{
		padding: 6px 35px 0 10;
	}

	.ui-tooltip-tipsy .ui-tooltip-content{
		padding: 6px 10;
	}

	.ui-tooltip-tipsy .ui-tooltip-icon{
		border-color: #222;
		text-shadow: none;
	}

	.ui-tooltip-tipsy .ui-tooltip-titlebar .ui-state-hover{
		border-color: #303030;
	}


/* Tipped style */
.ui-tooltip-tipped{

}

	.ui-tooltip-tipped .ui-tooltip-titlebar,
	.ui-tooltip-tipped .ui-tooltip-content{
		border: 3px solid #959FA9;
	}

	.ui-tooltip-tipped .ui-tooltip-titlebar{
		background: #3A79B8;
		background-image: -moz-linear-gradient(top, #3A79B8, #2E629D);
		background-image: -webkit-gradient(linear, left top, left bottom, from(#3A79B8), to(#2E629D));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#3A79B8,endColorstr=#2E629D);
		-ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorstr=#3A79B8,endColorstr=#2E629D)\";

		color: white;
		font-weight: normal;
		font-family: serif;

		border-bottom-width: 0;
		-moz-border-radius: 3px 3px 0 0;
		-webkit-border-radius: 3px 3px 0 0;
		border-radius: 3px 3px 0 0;
	}

	.ui-tooltip-tipped .ui-tooltip-content{
		background-color: #F9F9F9;
		color: #454545;

		-moz-border-radius: 0 0 3px 3px;
		-webkit-border-radius: 0 0 3px 3px;
		border-radius: 0 0 3px 3px;
	}

	.ui-tooltip-tipped .ui-tooltip-icon{
		border: 2px solid #285589;
		background: #285589;
	}

		.ui-tooltip-tipped .ui-tooltip-icon .ui-icon{
			background-color: #FBFBFB;
			color: #555;
		}

.eventsList  a{
    color: " . $color . ";
        font-weight:bolder;
}

.eventsList  a:hover{
    color: " . $color . ";
        font-weight:bolder;
}


.homeStatus {
height:40px;
width:395px;
border-bottom:1px solid #ccc;
padding-left:5px;
cursor: pointer;
background-color: #fff;

}

.floatingStatus {
position: fixed;
margin-top:-1px;
border:1px solid #ccc;
border-right:none;
margin-left: -201px;
-moz-box-shadow: 0 0 5px #ccc;
-webkit-box-shadow: 0 0 5px#ccc;
box-shadow: 0 0 5px #ccc;
}

#statusWrapper {
height:41px; width:400px;

}


.dayLoader {
background-color: #fff; width:200px; border:4px solid #ccc; position:fixed; margin-top:50px; margin-left:120px; padding-top:20px;padding-bottom:20px;text-align:center;
-moz-box-shadow: 0 0 5px #ccc;
-webkit-box-shadow: 0 0 80px #ccc;
box-shadow: 0 0 5px #ccc;
-moz-border-radius: 5px;
-khtml-border-radius: 5px;
-webkit-border-radius: 5px;

}


.addStatus {
color:" . $color . ";
font-weight:none;
float:right;
padding-bottom:4px; padding-left:5px; padding-right:5px;
cursor: pointer;
}


.addStatusActive {
background-color:#fff; border:1px solid #ccc; border-bottom:none;
-moz-box-shadow: 0 0 5px #ccc;
-webkit-box-shadow: 0 0 5px#ccc;
box-shadow: 0 0 5px #ccc;
}

.addStatusBox {
position:absolute; width:500px;  border:1px solid #ccc; background:#fff; margin-left:-302px; margin-top:-2px; display:none;
-moz-box-shadow: 0 0 5px #ccc;
-webkit-box-shadow: 0 0 5px#ccc;
box-shadow: 0 0 5px #ccc;
}


#sbox_menu {
border-bottom: 1px solid #f3f3f3;
margin-bottom:-1px;
}

#sbox_menu .item {
color: #666;
margin-left:10px;
padding-left:8px;
padding-right:8px;
padding-top:3px;
padding-bottom:2px;
font-weight:bolder;
}

#sbox_menu .item a{
color: #666;
}

#sbox_menu .item:hover {
background: #f1f1ec;
border-top: 3px solid #666;
border-left:1px solid #BABABA;
border-right:1px solid #BABABA;
padding-left:7px;
padding-right:7px;
}

#sbox_menu .active {
background: #f1f1ec;
border-top: 3px solid " . $color . ";
border-left:1px solid #BABABA;
border-right:1px solid #BABABA;
padding-left:7px;
padding-right:7px;
}

#statuser {
    clear:both;
}

#statuser .sect {
padding:2px;
border:1px solid #ccc;
width:185px;
float:left;
}

#statuser .num {
font-size:18px;
font-weight:bolder;
float:left;
}


.signupBoxer {
float:right;
background: #efefef;
width:250px;
margin-right:-15px;
margin-top:30px;
padding-top:10px;
padding-left:20px;
padding-bottom:20px;
border-right:none;
}


.colorswap {
border:1px solid #ccc;
width:300px;
float:left;
padding:10px;
cursor: pointer;
}


.folderPicker {
padding:5px;
border-bottom:1px solid #ccc;
background:#fff;
cursor: pointer;
}

.folderPicker:hover {
background: #efefef;
}

.folderActive {
background-color: " . $color . ";
color: #fff;
}

.folderActive:hover {
background: " . $color . ";
color: #fff;
}


#selectBox {
height:150px;
overflow-y: scroll;
}


#llheader {
background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
    padding:4px;
    font-size:14px;
    border: 1px solid #ccc;
}

#managebar {
    border-bottom: 1px solid #ccc;
    height:23px;
}

#managebar li {
background: #CCC url(" . $imgServer . "header/bkg.png) repeat-x;
    list-style:none;
    display: inline;
    font-size:14px;
    padding:5px;
    border: 1px solid #ccc;
    border-bottom:none;
    margin-right:2px;

    		/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
		 /*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
        cursor:pointer;
        height:30px;
}

#managebar .active {
background: #fff;
border-bottom:1px solid #fff;
}








.guider {
  background: #FFF;
  border: 1px solid #666;
  font-family: arial;
  position: absolute;
  outline: none;
  z-index: 100000005 !important;
  padding: 4px 12px;
  width: 500px;
  z-index: 100;
  
  /* Shadow */
  -moz-box-shadow: 0 0px 8px #111;
  -webkit-box-shadow: 0 0px 8px #111;
  box-shadow: 0 0px 8px #111;
  /* End shadow */
  
  /* Rounded corners */
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  /* End rounded corners */
}

.guider_buttons {
  height: 36px;
  position: relative;
  width: 100%;
}

.guider_content {
  position: relative;
}

.guider_content h1 {
  color: " . $color . ";
  font-size: 21px;
  line-height:100%;
}

.guider_content p {
  color: #333;
  font-size: 13px;
}

.guider_button {
background: " . $color . " url(" . $imgServer . "main/sub_rep.png) repeat-x;
  border: solid 1px #4B5D7E;
  color: #FFF;
  cursor: pointer;
  display: inline-block;
  float: right;
  font-size: 12px;
  font-weight: bold;
  margin-left: 6px;
  min-width: 40px;
  padding: 3px 5px;
  text-align: center;
  text-decoration: none;
  /* Rounded corners */
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  /* End rounded corners */
}
.guider_button:hover {
background-color:#fff;
}

#guider_overlay {
 display:none;  
 background:#000000;  
 opacity:0.6;  
 filter:alpha(opacity=60);  
 position:fixed;  
 top:0px;  
 left:0px;  
 min-width:100%;  
 min-height:100%;  
  z-index: 1000000;
}

.guider_arrow {
  width: 42px;
  height: 42px;
  position: absolute;
  display: none;
  background-repeat: no-repeat;
  z-index: 100000006 !important;
  
  /**
   * For optimization, the arrows image is inlined in the css below.
   * 
   * To use your own arrows image, replace this background-image with your own arrows.
   * It should have four arrows, top, right, left, and down.
   */
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACoAAACoCAYAAACWu3yIAAAJQ0lEQVR42u2cW2sVVxiGk2xz0EQFTRTBnEBFEpMLDxVyMPceoigRvVFjcqsSTaKCJAhC0Ozkpj+gFPIHWm2htPQfiChoVaqglDYeqP0Hdr3hXWFlZWb2WjNr1syGDHzilT48ew5r3u+bVXHgwIGCqCpWJerr168VeasKAVbPWi+qVtQ6CZ030J2sHaIaRW0UVZc3YIAeFPWNqP2iOkS1imrKGzBAz4g6L2pI1DFRfaL2acCZnxIV79+///PevXvfCYBpUeOihkUN5g0Yfywdr169WpycnPxZABRFTRL4RF6Al0Hl8eLFi88EntWAe7MEXgUqj+fPn3/KE3AoqAL88caNGz9lDVwSNC/AxqAq8NjY2CMCT4i65APYGlQez5498wocG1QDfigAHijAxwncSeBGHdg7qDyePn36IQS4h8AtBG4gcMEG2BmoCnzlypUfXQM7B1WAFxVgPJovKsBY/DSL2solZk2p8zc1UHk8efLkHwH8g4C4T+ALoo5yxbZH1HaevzVRZlMHlcfjx48l8Iyoq1yt9REWd4cNuNAyB1UM/3Xt2rUFATUm6rSoQzxvN4mqDvv5vYPK4+XLl3/cvXt3SoANiNolagt//nyBLi4u/r2wsPAtQXcTtDY3oO/evftSLBYf8sLCeXqYD4XNufjpBeB/MzMzv3Nhfl3UOdrcyyu/nk+tbEABKF51ADgv6raoEb7q9BByBy+k2kxuT2/fvtUBR0WdEnVEVLeoNt6W1CeUvxt+AOCIBtguahstGr+OV7gEFLeb3wh4yxWgM1AATk1N/RoA2O8CMDGoAPziAzA26Js3b/4l4JwPQGvQ169fBwGeTBvQGNQAsC1NwJKgALxz584vBLwp6rIC2OULMBRUZFCfCVjMA+AqUGHwYx4BV8SOYrHwPWPHCQLK2FEFzDTYVYPcs3z5yhVgWDTeqSwWcheNl02zoWzaN2XTECvQ6E6er2dwJ8jqpQ//Ny/wg2QCW6GCJiUoLqrzuF1lBcoOzXmySNAqCbqeF9N+3qam8QDwDYnODO/nQ2TZQbYl0EpeRI28PeFeOoGnlG9QNjfG2ZjrINPSu74EXcfbUhtv+Hg6FfHc9wWJthEf38NkaCXT0iv00hXFn7+ON/ouPkJv+rRKm5P8v/eRpU6+QkvQUKtY7qUNiZ4WewGBNpdBNavbaPWkL6uKzRNBNnVQ3Wo/rc6laRXtoFI2V4BGWcWrSFqgbLLpNlfFOzqoV6uazd4wm6tAI6zeSsOqqc0wUGl1k2IVb55zeKfPwmYgqC+rbE8a2YwCDbWKKMdFW9LGZihogNVul1Zpc8LUZinQMKvzSPAc2LxkajMSNMTqqaRW2di1smkCqlptT2oVDV32Rq1slgSNsop02ZdNU1AnVpPYNAKNsoqmgikoW+ITfIOwsmkDmsgqevdJbBqDRli9bWJVs9lpa9MWVLd6RFpFdy5qsECx2RPHphVoXKscJhhXbDba2owDGmR1NMwqph44onGRNlvi2LQGjbKKznFaNuOChp2rRfTi1ZEMzo9cUGw2xLEZCzTEKt7Fr2NgQIJybuQqJ3I6kthMAqqvrHo4KDCOEQzMi3C4ZYhhVzNtFpJ0RZJabeKAAKYZhjAnwqGW08q40NYkNpOCSqsNTN32cj5kgHVIGcCqT2IzEahitZanwHbezHdzPKhFaVrUJLHpArSSiXUtrW3mWNAWwm9wAZkYVIGt4mlQTega/t1Z48JZM0A2KtRy3Qsti1oDXQNdA012B5Gtz0IeAeU9uZbNsKWmch4B6/jYbeQaYqlNn0fAJi4dO9lmxDLxYJ4AtxGwi8vD4+zLooF7Jo+Ag2xwIAeYRqcbrfGsADdpgP0Mii9zlKmIRpza4c4lYFCzOC+AczQY2nXxCditAI5wIHEO6bVJsy1twPakgE5ADQFP6YBxGmu+AOcBmKRH5QswdrvHCtQA8IgOiGaEC0AjUEtAfBwwj6zUJWBJUO2dvUFZLKiAo2kDmoCqKYiMbHr4LF5hMCoaTxVUyZXqGdXIEOwcP/EpIrj1AWgCWs2IppXhFyLEcWSgamCbB9BaZkgIvQYQJyL7zGq4MAq0hqBI5gaQeSKgzSNoNS+kFmadCGbHEHkjn88FKGHXMTZsYiDbx/MUufwMOh5oz+QBtIo//0Ze+Xv4onWUnQ60Ze4DGN25LEErFdh65vDN7HD08OXrIoEfoN+J5qx3UM2s+oRq5HnbqQBf4suYBP7gHTQuMKYdXALHbTDIyEUmGq0E7g0CxmSOd9CQjEgmHK2cbujl3IgEnsWsUxJg16GWETDm8ryCxgAe5jzeLCYdbYDTjg2dAfvKOUsCY84ZQ9leQZMCYybfK6gFcJ8GXAQwPsnwCmoJPEhgPJqn8ZGLt9gxJvAxrtb8B7kW0XgrFz/ZRuNl12wou/ZN2TXE1nqha6BlDSquKJdVGVBO/m1XcOo4UQ3vgSvGifIAKt/9NzACkgNam3mzXt4nJ0tQNU1p4uvzLiaArUxYlnceyhK0oIS9eximySHCw8o2ScsDrk5BLQcItyoh2mnEk9zCa0jZeGrV55Ml/m2noAWaauZSDGBjyFAR+HLhe44pShtPAaOxYWegis1GrhuR8F1FdipfHbjv2HWu2LvZ9jGy6gRUG3BtoTHEkDNqwIucnx9Nj7Dd025q1RVoVcBn7uPISfU3R26Wdps9KWOriUG1D1ylTWSk94PSZ7R3uB/UqI1VF6DGNuXB/cmsrCYC1Wy20ibCrwdR0bhi1fhcTQoqbTapWzAgYS6VG9lajQ0aYLNX2jTJ7dHMVaz2l7KaBFS1uc/Gpmb1lonVWKAlbBpn9DZW44LqNhFmTSCbt02NuQFgSavWoK5s2lqNA+rMpjy4Y1ykVSvQCJuzSbobAVZXraxsQcNsPkraM1KsngyyarPCD7I5nNSmYvUL9+MLtGoDGmRz0oXNEKtdqlVT0FCbcRpZYQfm82ysGttEP8h1x9jGaiY25YGxTFq9rFjdGGQ1M5ua1ZulrEbZ7EvTpq1V3WadbhONqbTnRbj5ZaRVE5uf0gal1SKt9gVZDbM56MtmgNVBWm1SrUbZLAY1T9M6MHsfZVXfjq6Drb1xnzY1qxMBn7lXBm3whwxpWu3s+jrwyQU3+DsbtMHfqi0T0dHNaliQu8sGbplYFptQ/g/UqiA7u61evwAAAABJRU5ErkJggg==);
  *background-image: url('" . $imgServer . "/guide/guider_arrows.png');
}

.guider_arrow_right {
  display: block;
  background-position: 0px 0px;
  right: -42px;
}
.guider_arrow_down {
  display: block;
  background-position: 0px -42px;
  bottom: -42px;
}
.guider_arrow_up {
  display: block;
  background-position: 0px -126px;
  top: -42px;
}
.guider_arrow_left {
  display: block;
  background-position: 0px -84px;
  left: -42px;
}

";
?>