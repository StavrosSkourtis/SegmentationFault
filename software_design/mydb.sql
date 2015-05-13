-- phpMyAdmin SQL Dump
-- version 4.0.10.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2015 at 04:16 PM
-- Server version: 5.1.72-community
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
drop table if exists QuestionTags;
drop table if exists Tag;
drop table if exists QuestionScore;
drop table if exists AnswerScore;
drop table if exists ACommentScore;
drop table if exists QCommentScore;
drop table if exists QuestionComment;
drop table if exists AnswerComment;
drop table if exists Answer;
drop table if exists Question;
drop table if exists User;
drop table if exists UserType;


--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `acommentscore`
--

CREATE TABLE IF NOT EXISTS `acommentscore` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  PRIMARY KEY (`cid`,`uid`),
  KEY `ascore_user_id_idx` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `html` longblob NOT NULL,
  `user` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `edit_date` date DEFAULT NULL,
  PRIMARY KEY (`aid`),
  KEY `answer_question_key_idx` (`question`),
  KEY `answer_user_key_idx` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `answercomment`
--

CREATE TABLE IF NOT EXISTS `answercomment` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(250) NOT NULL,
  `user` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `edit_date` date DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `a_comment_user_key_idx` (`user`),
  KEY `a_comment_answer_key_idx` (`answer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `answerscore`
--

CREATE TABLE IF NOT EXISTS `answerscore` (
  `aid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  PRIMARY KEY (`aid`,`uid`),
  KEY `ascore_user_uid_idx` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qcommentscore`
--

CREATE TABLE IF NOT EXISTS `qcommentscore` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  PRIMARY KEY (`cid`,`uid`),
  KEY `qcomment_user_key_idx` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `html` longblob NOT NULL,
  `user` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `edit_date` date DEFAULT NULL,
  PRIMARY KEY (`qid`),
  KEY `question_user_key_idx` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=214 ;


-- --------------------------------------------------------

--
-- Table structure for table `questioncomment`
--

CREATE TABLE IF NOT EXISTS `questioncomment` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(250) NOT NULL,
  `user` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `edit_date` date DEFAULT NULL,
  `question` int(11) NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `a_comment_user_key_idx` (`user`),
  KEY `a_comment_question_key_idx` (`question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questionscore`
--

CREATE TABLE IF NOT EXISTS `questionscore` (
  `qid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  PRIMARY KEY (`qid`,`uid`),
  KEY `qscore_user_key_idx` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Table structure for table `questiontags`
--

CREATE TABLE IF NOT EXISTS `questiontags` (
  `question` int(11) NOT NULL,
  `tag` int(11) NOT NULL,
  PRIMARY KEY (`question`,`tag`),
  KEY `question_tags_t_key_idx` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_string` varchar(45) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_string`) VALUES
( 'Java'),('c++'),('c'),('Perl'),('Sql'),('Oracle'),('php'),('OpenGL'),('OpenAL'),('OpenCL'),('Security'),('c#');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(65) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `join_date` date NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `user_icon` varchar(45) NOT NULL DEFAULT 'users/images/defaultUserIcon.jpg',
  PRIMARY KEY (`uid`),
  KEY `user_type_key_idx` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(45) NOT NULL,
  PRIMARY KEY (`type_id`,`type_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`type_id`, `type_name`) VALUES
(1, 'Admin'),
(2, 'User');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acommentscore`
--
ALTER TABLE `acommentscore`
  ADD CONSTRAINT `ascore_comment_id` FOREIGN KEY (`cid`) REFERENCES `answercomment` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ascore_user_id` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_question_key` FOREIGN KEY (`question`) REFERENCES `question` (`qid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `answer_user_key` FOREIGN KEY (`user`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `answercomment`
--
ALTER TABLE `answercomment`
  ADD CONSTRAINT `a_comment_user_key` FOREIGN KEY (`user`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `a_comment_answer_key` FOREIGN KEY (`answer`) REFERENCES `answer` (`aid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `answerscore`
--
ALTER TABLE `answerscore`
  ADD CONSTRAINT `ascore_answer_aid` FOREIGN KEY (`aid`) REFERENCES `answer` (`aid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ascore_user_uid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `qcommentscore`
--
ALTER TABLE `qcommentscore`
  ADD CONSTRAINT `qcomment_comment_key` FOREIGN KEY (`cid`) REFERENCES `questioncomment` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `qcomment_user_key` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_user_key` FOREIGN KEY (`user`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `questioncomment`
--
ALTER TABLE `questioncomment`
  ADD CONSTRAINT `q_comment_user_key` FOREIGN KEY (`user`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `q_comment_question_key` FOREIGN KEY (`question`) REFERENCES `question` (`qid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `questionscore`
--
ALTER TABLE `questionscore`
  ADD CONSTRAINT `qscore_question_key` FOREIGN KEY (`qid`) REFERENCES `question` (`qid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `qscore_user_key` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `questiontags`
--
ALTER TABLE `questiontags`
  ADD CONSTRAINT `question_tags_q_key` FOREIGN KEY (`question`) REFERENCES `question` (`qid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `question_tags_t_key` FOREIGN KEY (`tag`) REFERENCES `tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_type_key` FOREIGN KEY (`type`) REFERENCES `usertype` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
