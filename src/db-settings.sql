

CREATE TABLE `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `about` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO about VALUES("1","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius enim, accusantium repellat ex autem numquam iure officiis facere vitae itaque?

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam qui vel cupiditate exercitationem, ea fuga est velit nulla culpa modi quis iste tempora non, suscipit repellendus labore voluptatem dicta amet?

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam qui vel cupiditate exercitationem, ea fuga est velit nulla culpa modi quis iste tempora non, suscipit repellendus labore voluptatem dicta amet?");





CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO admin VALUES("1","admin","$2y$10$MilDJm3l8BP.0xHChL/liOBpFEQcHaW3gejq.SuQYfs459KDgwhR.");





CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;





CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `value` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO contact VALUES("1","address","123 ABC Street, XYZ Road");
INSERT INTO contact VALUES("2","phone","+234-80-1234-5678");
INSERT INTO contact VALUES("3","facebook","username");
INSERT INTO contact VALUES("4","twitter","username");
INSERT INTO contact VALUES("5","instagram","username");
INSERT INTO contact VALUES("6","email","info@abc.com");





CREATE TABLE `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(1000) NOT NULL,
  `answer` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO faq VALUES("1","What is my name?","Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip");
INSERT INTO faq VALUES("4","Who am i?","I dont know");





CREATE TABLE `policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `policy` varchar(25000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO policy VALUES("1","Copyright 2011-2018 Twitter, Inc.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the \"Software\"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED \"AS IS\", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.");





CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(1000) NOT NULL,
  `category` varchar(500) NOT NULL,
  `images` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;





CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `timestamp` datetime NOT NULL,
  `address` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;





CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(250) NOT NULL,
  `password` varchar(200) NOT NULL,
  `code` int(11) NOT NULL DEFAULT '0',
  `expiration` int(11) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;




