# phpMyAdmin MySQL-Dump
# version 2.3.0
# http://phpwizard.net/phpMyAdmin/
# http://www.phpmyadmin.net/ (download page)
#
# Host: 192.168.0.53
# Generation Time: Nov 23, 2006 at 03:35 PM
# Server version: 4.00.17
# PHP Version: 4.4.4
# Database : `voidbot`
# --------------------------------------------------------

#
# Table structure for table `archivemsg`
#

DROP TABLE IF EXISTS archivemsg;
CREATE TABLE archivemsg (
  aid int(10) unsigned NOT NULL auto_increment,
  timestamp int(10) unsigned NOT NULL default '0',
  chatname varchar(255) NOT NULL default '',
  authorhandle varchar(255) NOT NULL default '',
  authordisplayname varchar(255) NOT NULL default '',
  body text NOT NULL,
  type tinyint(4) NOT NULL default '4',
  PRIMARY KEY  (aid)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `chat`
#

DROP TABLE IF EXISTS chat;
CREATE TABLE chat (
  cid int(10) unsigned NOT NULL auto_increment,
  chatname varchar(255) NOT NULL default '',
  friendlyname varchar(255) NOT NULL default '',
  archive tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (cid),
  KEY chatname (chatname)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `karma`
#

DROP TABLE IF EXISTS karma;
CREATE TABLE karma (
  name varchar(255) NOT NULL default '',
  karma int(11) NOT NULL default '0',
  PRIMARY KEY  (name)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `watchdog`
#

DROP TABLE IF EXISTS watchdog;
CREATE TABLE watchdog (
  id int(5) NOT NULL auto_increment,
  user int(6) NOT NULL default '0',
  type varchar(16) NOT NULL default '',
  message text NOT NULL,
  location varchar(128) NOT NULL default '',
  hostname varchar(128) NOT NULL default '',
  timestamp int(11) NOT NULL default '0',
  sid int(10) unsigned NOT NULL default '0',
  referrer varchar(128) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

