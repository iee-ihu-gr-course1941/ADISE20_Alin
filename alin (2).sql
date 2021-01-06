-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 06 Ιαν 2021 στις 22:50:30
-- Έκδοση διακομιστή: 10.4.17-MariaDB
-- Έκδοση PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `alin`
--

DELIMITER $$
--
-- Διαδικασίες
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `clean_board` ()  BEGIN
	replace into board select * from board_empty;
	update `players` set username=null, token=null;
    update `game_status` set `status`='not active', `p_turn`=null, `result`=null;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `move_piece` (`x1` TINYINT, `y1` TINYINT, `x2` TINYINT, `y2` TINYINT)  BEGIN
	

	DECLARE p, p_color CHAR;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
		BEGIN
			ROLLBACK;
		END;

	SELECT piece, piece_color INTO p, p_color
	FROM `board` WHERE X=x1 AND Y=y1;
    
	START TRANSACTION;
		UPDATE board
		SET piece=p, piece_color=p_color
		WHERE X=x2 AND Y=y2;

		UPDATE board
		SET piece=NULL,piece_color=NULL
		WHERE X=x1 AND Y=y1;
        update game_status set p_turn=if(p_color='W','B','W');
	COMMIT;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `board`
--

CREATE TABLE `board` (
  `x` tinyint(1) NOT NULL,
  `y` tinyint(1) NOT NULL,
  `piece_color` enum('B','W') DEFAULT NULL,
  `piece` enum('p1','p2','p3','p4','p5','p6','p7','p8','p9','p10','p11','p12','p13','p14','p15') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `board`
--

INSERT INTO `board` (`x`, `y`, `piece_color`, `piece`) VALUES
(1, 1, NULL, NULL),
(1, 2, NULL, NULL),
(1, 3, NULL, NULL),
(1, 4, NULL, NULL),
(1, 5, NULL, NULL),
(1, 6, NULL, NULL),
(1, 7, NULL, NULL),
(1, 8, NULL, NULL),
(1, 9, NULL, NULL),
(1, 10, NULL, NULL),
(1, 11, NULL, NULL),
(1, 12, NULL, NULL),
(1, 13, NULL, NULL),
(1, 14, NULL, NULL),
(1, 15, NULL, NULL),
(1, 16, NULL, NULL),
(1, 17, NULL, NULL),
(1, 18, NULL, NULL),
(1, 19, NULL, NULL),
(1, 20, NULL, NULL),
(1, 21, NULL, NULL),
(1, 22, NULL, NULL),
(1, 23, NULL, NULL),
(1, 24, NULL, NULL),
(1, 25, NULL, NULL),
(1, 26, NULL, NULL),
(1, 27, NULL, NULL),
(1, 28, NULL, NULL),
(1, 29, NULL, NULL),
(1, 30, NULL, NULL),
(2, 1, NULL, NULL),
(2, 2, NULL, NULL),
(2, 3, NULL, NULL),
(2, 4, NULL, NULL),
(2, 5, NULL, NULL),
(2, 6, NULL, NULL),
(2, 7, NULL, NULL),
(2, 8, NULL, NULL),
(2, 9, NULL, NULL),
(2, 10, NULL, NULL),
(2, 11, NULL, NULL),
(2, 12, NULL, NULL),
(2, 13, NULL, NULL),
(2, 14, NULL, NULL),
(2, 15, NULL, NULL),
(2, 16, NULL, NULL),
(2, 17, NULL, NULL),
(2, 18, NULL, NULL),
(2, 19, NULL, NULL),
(2, 20, NULL, NULL),
(2, 21, NULL, NULL),
(2, 22, NULL, NULL),
(2, 23, NULL, NULL),
(2, 24, NULL, NULL),
(2, 25, NULL, NULL),
(2, 26, NULL, NULL),
(2, 27, NULL, NULL),
(2, 28, NULL, NULL),
(2, 29, NULL, NULL),
(2, 30, NULL, NULL),
(3, 1, NULL, NULL),
(3, 2, NULL, NULL),
(3, 3, NULL, NULL),
(3, 4, NULL, NULL),
(3, 5, NULL, NULL),
(3, 6, NULL, NULL),
(3, 7, NULL, NULL),
(3, 8, NULL, NULL),
(3, 9, NULL, NULL),
(3, 10, NULL, NULL),
(3, 11, NULL, NULL),
(3, 12, NULL, NULL),
(3, 13, NULL, NULL),
(3, 14, NULL, NULL),
(3, 15, NULL, NULL),
(3, 16, NULL, NULL),
(3, 17, NULL, NULL),
(3, 18, NULL, NULL),
(3, 19, NULL, NULL),
(3, 20, NULL, NULL),
(3, 21, NULL, NULL),
(3, 22, NULL, NULL),
(3, 23, NULL, NULL),
(3, 24, NULL, NULL),
(3, 25, NULL, NULL),
(3, 26, NULL, NULL),
(3, 27, NULL, NULL),
(3, 28, NULL, NULL),
(3, 29, NULL, NULL),
(3, 30, NULL, NULL),
(4, 1, NULL, NULL),
(4, 2, NULL, NULL),
(4, 3, NULL, NULL),
(4, 4, NULL, NULL),
(4, 5, NULL, NULL),
(4, 6, NULL, NULL),
(4, 7, NULL, NULL),
(4, 8, NULL, NULL),
(4, 9, NULL, NULL),
(4, 10, NULL, NULL),
(4, 11, NULL, NULL),
(4, 12, NULL, NULL),
(4, 13, NULL, NULL),
(4, 14, NULL, NULL),
(4, 15, NULL, NULL),
(4, 16, NULL, NULL),
(4, 17, NULL, NULL),
(4, 18, NULL, NULL),
(4, 19, NULL, NULL),
(4, 20, NULL, NULL),
(4, 21, NULL, NULL),
(4, 22, NULL, NULL),
(4, 23, NULL, NULL),
(4, 24, NULL, NULL),
(4, 25, NULL, NULL),
(4, 26, NULL, NULL),
(4, 27, NULL, NULL),
(4, 28, NULL, NULL),
(4, 29, NULL, NULL),
(4, 30, NULL, NULL),
(5, 1, NULL, NULL),
(5, 2, NULL, NULL),
(5, 3, NULL, NULL),
(5, 4, NULL, NULL),
(5, 5, NULL, NULL),
(5, 6, NULL, NULL),
(5, 7, NULL, NULL),
(5, 8, NULL, NULL),
(5, 9, NULL, NULL),
(5, 10, NULL, NULL),
(5, 11, NULL, NULL),
(5, 12, NULL, NULL),
(5, 13, NULL, NULL),
(5, 14, NULL, NULL),
(5, 15, NULL, NULL),
(5, 16, 'W', ''),
(5, 17, NULL, NULL),
(5, 18, NULL, NULL),
(5, 19, NULL, NULL),
(5, 20, NULL, NULL),
(5, 21, NULL, NULL),
(5, 22, NULL, NULL),
(5, 23, NULL, NULL),
(5, 24, NULL, NULL),
(5, 25, NULL, NULL),
(5, 26, NULL, NULL),
(5, 27, NULL, NULL),
(5, 28, NULL, NULL),
(5, 29, NULL, NULL),
(5, 30, NULL, NULL),
(6, 1, NULL, NULL),
(6, 2, NULL, NULL),
(6, 3, NULL, NULL),
(6, 4, NULL, NULL),
(6, 5, NULL, NULL),
(6, 6, NULL, NULL),
(6, 7, NULL, NULL),
(6, 8, NULL, NULL),
(6, 9, NULL, NULL),
(6, 10, NULL, NULL),
(6, 11, NULL, NULL),
(6, 12, NULL, NULL),
(6, 13, NULL, NULL),
(6, 14, NULL, NULL),
(6, 15, NULL, NULL),
(6, 16, NULL, NULL),
(6, 17, NULL, NULL),
(6, 18, NULL, NULL),
(6, 19, NULL, NULL),
(6, 20, NULL, NULL),
(6, 21, NULL, NULL),
(6, 22, NULL, NULL),
(6, 23, NULL, NULL),
(6, 24, NULL, NULL),
(6, 25, NULL, NULL),
(6, 26, NULL, NULL),
(6, 27, NULL, NULL),
(6, 28, NULL, NULL),
(6, 29, NULL, NULL),
(6, 30, NULL, NULL),
(7, 1, NULL, NULL),
(7, 2, NULL, NULL),
(7, 3, NULL, NULL),
(7, 4, NULL, NULL),
(7, 5, NULL, NULL),
(7, 6, NULL, NULL),
(7, 7, NULL, NULL),
(7, 8, NULL, NULL),
(7, 9, NULL, NULL),
(7, 10, NULL, NULL),
(7, 11, NULL, NULL),
(7, 12, NULL, NULL),
(7, 13, NULL, NULL),
(7, 14, NULL, NULL),
(7, 15, NULL, NULL),
(7, 16, NULL, NULL),
(7, 17, NULL, NULL),
(7, 18, NULL, NULL),
(7, 19, NULL, NULL),
(7, 20, NULL, NULL),
(7, 21, NULL, NULL),
(7, 22, NULL, NULL),
(7, 23, NULL, NULL),
(7, 24, NULL, NULL),
(7, 25, NULL, NULL),
(7, 26, NULL, NULL),
(7, 27, NULL, NULL),
(7, 28, NULL, NULL),
(7, 29, NULL, NULL),
(7, 30, NULL, NULL),
(8, 1, NULL, NULL),
(8, 2, NULL, NULL),
(8, 3, NULL, NULL),
(8, 4, NULL, NULL),
(8, 5, NULL, NULL),
(8, 6, NULL, NULL),
(8, 7, NULL, NULL),
(8, 8, NULL, NULL),
(8, 9, NULL, NULL),
(8, 10, NULL, NULL),
(8, 11, NULL, NULL),
(8, 12, NULL, NULL),
(8, 13, NULL, NULL),
(8, 14, NULL, NULL),
(8, 15, NULL, NULL),
(8, 16, NULL, NULL),
(8, 17, NULL, NULL),
(8, 18, NULL, NULL),
(8, 19, NULL, NULL),
(8, 20, NULL, NULL),
(8, 21, NULL, NULL),
(8, 22, NULL, NULL),
(8, 23, NULL, NULL),
(8, 24, NULL, NULL),
(8, 25, NULL, NULL),
(8, 26, NULL, NULL),
(8, 27, NULL, NULL),
(8, 28, NULL, NULL),
(8, 29, NULL, NULL),
(8, 30, NULL, NULL),
(9, 1, NULL, NULL),
(9, 2, NULL, NULL),
(9, 3, NULL, NULL),
(9, 4, NULL, NULL),
(9, 5, NULL, NULL),
(9, 6, NULL, NULL),
(9, 7, NULL, NULL),
(9, 8, NULL, NULL),
(9, 9, NULL, NULL),
(9, 10, NULL, NULL),
(9, 11, NULL, NULL),
(9, 12, NULL, NULL),
(9, 13, NULL, NULL),
(9, 14, NULL, NULL),
(9, 15, NULL, NULL),
(9, 16, NULL, NULL),
(9, 17, NULL, NULL),
(9, 18, NULL, NULL),
(9, 19, NULL, NULL),
(9, 20, NULL, NULL),
(9, 21, NULL, NULL),
(9, 22, NULL, NULL),
(9, 23, NULL, NULL),
(9, 24, NULL, NULL),
(9, 25, NULL, NULL),
(9, 26, NULL, NULL),
(9, 27, NULL, NULL),
(9, 28, NULL, NULL),
(9, 29, NULL, NULL),
(9, 30, NULL, NULL),
(10, 1, NULL, NULL),
(10, 2, NULL, NULL),
(10, 3, NULL, NULL),
(10, 4, NULL, NULL),
(10, 5, NULL, NULL),
(10, 6, NULL, NULL),
(10, 7, NULL, NULL),
(10, 8, NULL, NULL),
(10, 9, NULL, NULL),
(10, 10, NULL, NULL),
(10, 11, NULL, NULL),
(10, 12, NULL, NULL),
(10, 13, NULL, NULL),
(10, 14, NULL, NULL),
(10, 15, NULL, NULL),
(10, 16, NULL, NULL),
(10, 17, NULL, NULL),
(10, 18, NULL, NULL),
(10, 19, NULL, NULL),
(10, 20, NULL, NULL),
(10, 21, NULL, NULL),
(10, 22, NULL, NULL),
(10, 23, NULL, NULL),
(10, 24, NULL, NULL),
(10, 25, NULL, NULL),
(10, 26, NULL, NULL),
(10, 27, NULL, NULL),
(10, 28, NULL, NULL),
(10, 29, NULL, NULL),
(10, 30, NULL, NULL),
(11, 1, NULL, NULL),
(11, 2, NULL, NULL),
(11, 3, NULL, NULL),
(11, 4, NULL, NULL),
(11, 5, NULL, NULL),
(11, 6, NULL, NULL),
(11, 7, NULL, NULL),
(11, 8, NULL, NULL),
(11, 9, NULL, NULL),
(11, 10, NULL, NULL),
(11, 11, NULL, NULL),
(11, 12, NULL, NULL),
(11, 13, NULL, NULL),
(11, 14, NULL, NULL),
(11, 15, NULL, NULL),
(11, 16, NULL, NULL),
(11, 17, NULL, NULL),
(11, 18, NULL, NULL),
(11, 19, NULL, NULL),
(11, 20, NULL, NULL),
(11, 21, NULL, NULL),
(11, 22, NULL, NULL),
(11, 23, NULL, NULL),
(11, 24, NULL, NULL),
(11, 25, NULL, NULL),
(11, 26, NULL, NULL),
(11, 27, NULL, NULL),
(11, 28, NULL, NULL),
(11, 29, NULL, NULL),
(11, 30, NULL, NULL),
(12, 1, 'B', 'p1'),
(12, 2, 'B', 'p2'),
(12, 3, 'B', 'p3'),
(12, 4, 'B', 'p4'),
(12, 5, 'B', 'p5'),
(12, 6, 'B', 'p6'),
(12, 7, 'B', 'p7'),
(12, 8, 'B', 'p8'),
(12, 9, 'B', 'p9'),
(12, 10, 'B', 'p10'),
(12, 11, 'B', 'p11'),
(12, 12, 'B', 'p12'),
(12, 13, 'B', 'p13'),
(12, 14, 'B', 'p14'),
(12, 15, 'B', 'p15'),
(12, 16, NULL, NULL),
(12, 17, 'W', 'p14'),
(12, 18, 'W', 'p13'),
(12, 19, 'W', 'p12'),
(12, 20, 'W', 'p11'),
(12, 21, 'W', 'p10'),
(12, 22, 'W', 'p9'),
(12, 23, 'W', 'p8'),
(12, 24, 'W', 'p7'),
(12, 25, 'W', 'p6'),
(12, 26, 'W', 'p5'),
(12, 27, 'W', 'p4'),
(12, 28, 'W', 'p3'),
(12, 29, 'W', 'p2'),
(12, 30, 'W', 'p1');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `board_empty`
--

CREATE TABLE `board_empty` (
  `x` tinyint(1) NOT NULL,
  `y` tinyint(1) NOT NULL,
  `piece_color` enum('B','W') DEFAULT NULL,
  `piece` enum('p1','p2','p3','p4','p5','p6','p7','p8','p9','p10','p11','p12','p13','p14','p15') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `board_empty`
--

INSERT INTO `board_empty` (`x`, `y`, `piece_color`, `piece`) VALUES
(1, 1, NULL, NULL),
(1, 2, NULL, NULL),
(1, 3, NULL, NULL),
(1, 4, NULL, NULL),
(1, 5, NULL, NULL),
(1, 6, NULL, NULL),
(1, 7, NULL, NULL),
(1, 8, NULL, NULL),
(1, 9, NULL, NULL),
(1, 10, NULL, NULL),
(1, 11, NULL, NULL),
(1, 12, NULL, NULL),
(1, 13, NULL, NULL),
(1, 14, NULL, NULL),
(1, 15, NULL, NULL),
(1, 16, NULL, NULL),
(1, 17, NULL, NULL),
(1, 18, NULL, NULL),
(1, 19, NULL, NULL),
(1, 20, NULL, NULL),
(1, 21, NULL, NULL),
(1, 22, NULL, NULL),
(1, 23, NULL, NULL),
(1, 24, NULL, NULL),
(1, 25, NULL, NULL),
(1, 26, NULL, NULL),
(1, 27, NULL, NULL),
(1, 28, NULL, NULL),
(1, 29, NULL, NULL),
(1, 30, NULL, NULL),
(2, 1, NULL, NULL),
(2, 2, NULL, NULL),
(2, 3, NULL, NULL),
(2, 4, NULL, NULL),
(2, 5, NULL, NULL),
(2, 6, NULL, NULL),
(2, 7, NULL, NULL),
(2, 8, NULL, NULL),
(2, 9, NULL, NULL),
(2, 10, NULL, NULL),
(2, 11, NULL, NULL),
(2, 12, NULL, NULL),
(2, 13, NULL, NULL),
(2, 14, NULL, NULL),
(2, 15, NULL, NULL),
(2, 16, NULL, NULL),
(2, 17, NULL, NULL),
(2, 18, NULL, NULL),
(2, 19, NULL, NULL),
(2, 20, NULL, NULL),
(2, 21, NULL, NULL),
(2, 22, NULL, NULL),
(2, 23, NULL, NULL),
(2, 24, NULL, NULL),
(2, 25, NULL, NULL),
(2, 26, NULL, NULL),
(2, 27, NULL, NULL),
(2, 28, NULL, NULL),
(2, 29, NULL, NULL),
(2, 30, NULL, NULL),
(3, 1, NULL, NULL),
(3, 2, NULL, NULL),
(3, 3, NULL, NULL),
(3, 4, NULL, NULL),
(3, 5, NULL, NULL),
(3, 6, NULL, NULL),
(3, 7, NULL, NULL),
(3, 8, NULL, NULL),
(3, 9, NULL, NULL),
(3, 10, NULL, NULL),
(3, 11, NULL, NULL),
(3, 12, NULL, NULL),
(3, 13, NULL, NULL),
(3, 14, NULL, NULL),
(3, 15, NULL, NULL),
(3, 16, NULL, NULL),
(3, 17, NULL, NULL),
(3, 18, NULL, NULL),
(3, 19, NULL, NULL),
(3, 20, NULL, NULL),
(3, 21, NULL, NULL),
(3, 22, NULL, NULL),
(3, 23, NULL, NULL),
(3, 24, NULL, NULL),
(3, 25, NULL, NULL),
(3, 26, NULL, NULL),
(3, 27, NULL, NULL),
(3, 28, NULL, NULL),
(3, 29, NULL, NULL),
(3, 30, NULL, NULL),
(4, 1, NULL, NULL),
(4, 2, NULL, NULL),
(4, 3, NULL, NULL),
(4, 4, NULL, NULL),
(4, 5, NULL, NULL),
(4, 6, NULL, NULL),
(4, 7, NULL, NULL),
(4, 8, NULL, NULL),
(4, 9, NULL, NULL),
(4, 10, NULL, NULL),
(4, 11, NULL, NULL),
(4, 12, NULL, NULL),
(4, 13, NULL, NULL),
(4, 14, NULL, NULL),
(4, 15, NULL, NULL),
(4, 16, NULL, NULL),
(4, 17, NULL, NULL),
(4, 18, NULL, NULL),
(4, 19, NULL, NULL),
(4, 20, NULL, NULL),
(4, 21, NULL, NULL),
(4, 22, NULL, NULL),
(4, 23, NULL, NULL),
(4, 24, NULL, NULL),
(4, 25, NULL, NULL),
(4, 26, NULL, NULL),
(4, 27, NULL, NULL),
(4, 28, NULL, NULL),
(4, 29, NULL, NULL),
(4, 30, NULL, NULL),
(5, 1, NULL, NULL),
(5, 2, NULL, NULL),
(5, 3, NULL, NULL),
(5, 4, NULL, NULL),
(5, 5, NULL, NULL),
(5, 6, NULL, NULL),
(5, 7, NULL, NULL),
(5, 8, NULL, NULL),
(5, 9, NULL, NULL),
(5, 10, NULL, NULL),
(5, 11, NULL, NULL),
(5, 12, NULL, NULL),
(5, 13, NULL, NULL),
(5, 14, NULL, NULL),
(5, 15, NULL, NULL),
(5, 16, NULL, NULL),
(5, 17, NULL, NULL),
(5, 18, NULL, NULL),
(5, 19, NULL, NULL),
(5, 20, NULL, NULL),
(5, 21, NULL, NULL),
(5, 22, NULL, NULL),
(5, 23, NULL, NULL),
(5, 24, NULL, NULL),
(5, 25, NULL, NULL),
(5, 26, NULL, NULL),
(5, 27, NULL, NULL),
(5, 28, NULL, NULL),
(5, 29, NULL, NULL),
(5, 30, NULL, NULL),
(6, 1, NULL, NULL),
(6, 2, NULL, NULL),
(6, 3, NULL, NULL),
(6, 4, NULL, NULL),
(6, 5, NULL, NULL),
(6, 6, NULL, NULL),
(6, 7, NULL, NULL),
(6, 8, NULL, NULL),
(6, 9, NULL, NULL),
(6, 10, NULL, NULL),
(6, 11, NULL, NULL),
(6, 12, NULL, NULL),
(6, 13, NULL, NULL),
(6, 14, NULL, NULL),
(6, 15, NULL, NULL),
(6, 16, NULL, NULL),
(6, 17, NULL, NULL),
(6, 18, NULL, NULL),
(6, 19, NULL, NULL),
(6, 20, NULL, NULL),
(6, 21, NULL, NULL),
(6, 22, NULL, NULL),
(6, 23, NULL, NULL),
(6, 24, NULL, NULL),
(6, 25, NULL, NULL),
(6, 26, NULL, NULL),
(6, 27, NULL, NULL),
(6, 28, NULL, NULL),
(6, 29, NULL, NULL),
(6, 30, NULL, NULL),
(7, 1, NULL, NULL),
(7, 2, NULL, NULL),
(7, 3, NULL, NULL),
(7, 4, NULL, NULL),
(7, 5, NULL, NULL),
(7, 6, NULL, NULL),
(7, 7, NULL, NULL),
(7, 8, NULL, NULL),
(7, 9, NULL, NULL),
(7, 10, NULL, NULL),
(7, 11, NULL, NULL),
(7, 12, NULL, NULL),
(7, 13, NULL, NULL),
(7, 14, NULL, NULL),
(7, 15, NULL, NULL),
(7, 16, NULL, NULL),
(7, 17, NULL, NULL),
(7, 18, NULL, NULL),
(7, 19, NULL, NULL),
(7, 20, NULL, NULL),
(7, 21, NULL, NULL),
(7, 22, NULL, NULL),
(7, 23, NULL, NULL),
(7, 24, NULL, NULL),
(7, 25, NULL, NULL),
(7, 26, NULL, NULL),
(7, 27, NULL, NULL),
(7, 28, NULL, NULL),
(7, 29, NULL, NULL),
(7, 30, NULL, NULL),
(8, 1, NULL, NULL),
(8, 2, NULL, NULL),
(8, 3, NULL, NULL),
(8, 4, NULL, NULL),
(8, 5, NULL, NULL),
(8, 6, NULL, NULL),
(8, 7, NULL, NULL),
(8, 8, NULL, NULL),
(8, 9, NULL, NULL),
(8, 10, NULL, NULL),
(8, 11, NULL, NULL),
(8, 12, NULL, NULL),
(8, 13, NULL, NULL),
(8, 14, NULL, NULL),
(8, 15, NULL, NULL),
(8, 16, NULL, NULL),
(8, 17, NULL, NULL),
(8, 18, NULL, NULL),
(8, 19, NULL, NULL),
(8, 20, NULL, NULL),
(8, 21, NULL, NULL),
(8, 22, NULL, NULL),
(8, 23, NULL, NULL),
(8, 24, NULL, NULL),
(8, 25, NULL, NULL),
(8, 26, NULL, NULL),
(8, 27, NULL, NULL),
(8, 28, NULL, NULL),
(8, 29, NULL, NULL),
(8, 30, NULL, NULL),
(9, 1, NULL, NULL),
(9, 2, NULL, NULL),
(9, 3, NULL, NULL),
(9, 4, NULL, NULL),
(9, 5, NULL, NULL),
(9, 6, NULL, NULL),
(9, 7, NULL, NULL),
(9, 8, NULL, NULL),
(9, 9, NULL, NULL),
(9, 10, NULL, NULL),
(9, 11, NULL, NULL),
(9, 12, NULL, NULL),
(9, 13, NULL, NULL),
(9, 14, NULL, NULL),
(9, 15, NULL, NULL),
(9, 16, NULL, NULL),
(9, 17, NULL, NULL),
(9, 18, NULL, NULL),
(9, 19, NULL, NULL),
(9, 20, NULL, NULL),
(9, 21, NULL, NULL),
(9, 22, NULL, NULL),
(9, 23, NULL, NULL),
(9, 24, NULL, NULL),
(9, 25, NULL, NULL),
(9, 26, NULL, NULL),
(9, 27, NULL, NULL),
(9, 28, NULL, NULL),
(9, 29, NULL, NULL),
(9, 30, NULL, NULL),
(10, 1, NULL, NULL),
(10, 2, NULL, NULL),
(10, 3, NULL, NULL),
(10, 4, NULL, NULL),
(10, 5, NULL, NULL),
(10, 6, NULL, NULL),
(10, 7, NULL, NULL),
(10, 8, NULL, NULL),
(10, 9, NULL, NULL),
(10, 10, NULL, NULL),
(10, 11, NULL, NULL),
(10, 12, NULL, NULL),
(10, 13, NULL, NULL),
(10, 14, NULL, NULL),
(10, 15, NULL, NULL),
(10, 16, NULL, NULL),
(10, 17, NULL, NULL),
(10, 18, NULL, NULL),
(10, 19, NULL, NULL),
(10, 20, NULL, NULL),
(10, 21, NULL, NULL),
(10, 22, NULL, NULL),
(10, 23, NULL, NULL),
(10, 24, NULL, NULL),
(10, 25, NULL, NULL),
(10, 26, NULL, NULL),
(10, 27, NULL, NULL),
(10, 28, NULL, NULL),
(10, 29, NULL, NULL),
(10, 30, NULL, NULL),
(11, 1, NULL, NULL),
(11, 2, NULL, NULL),
(11, 3, NULL, NULL),
(11, 4, NULL, NULL),
(11, 5, NULL, NULL),
(11, 6, NULL, NULL),
(11, 7, NULL, NULL),
(11, 8, NULL, NULL),
(11, 9, NULL, NULL),
(11, 10, NULL, NULL),
(11, 11, NULL, NULL),
(11, 12, NULL, NULL),
(11, 13, NULL, NULL),
(11, 14, NULL, NULL),
(11, 15, NULL, NULL),
(11, 16, NULL, NULL),
(11, 17, NULL, NULL),
(11, 18, NULL, NULL),
(11, 19, NULL, NULL),
(11, 20, NULL, NULL),
(11, 21, NULL, NULL),
(11, 22, NULL, NULL),
(11, 23, NULL, NULL),
(11, 24, NULL, NULL),
(11, 25, NULL, NULL),
(11, 26, NULL, NULL),
(11, 27, NULL, NULL),
(11, 28, NULL, NULL),
(11, 29, NULL, NULL),
(11, 30, NULL, NULL),
(12, 1, 'B', 'p1'),
(12, 2, 'B', 'p2'),
(12, 3, 'B', 'p3'),
(12, 4, 'B', 'p4'),
(12, 5, 'B', 'p5'),
(12, 6, 'B', 'p6'),
(12, 7, 'B', 'p7'),
(12, 8, 'B', 'p8'),
(12, 9, 'B', 'p9'),
(12, 10, 'B', 'p10'),
(12, 11, 'B', 'p11'),
(12, 12, 'B', 'p12'),
(12, 13, 'B', 'p13'),
(12, 14, 'B', 'p14'),
(12, 15, 'B', 'p15'),
(12, 16, 'W', 'p15'),
(12, 17, 'W', 'p14'),
(12, 18, 'W', 'p13'),
(12, 19, 'W', 'p12'),
(12, 20, 'W', 'p11'),
(12, 21, 'W', 'p10'),
(12, 22, 'W', 'p9'),
(12, 23, 'W', 'p8'),
(12, 24, 'W', 'p7'),
(12, 25, 'W', 'p6'),
(12, 26, 'W', 'p5'),
(12, 27, 'W', 'p4'),
(12, 28, 'W', 'p3'),
(12, 29, 'W', 'p2'),
(12, 30, 'W', 'p1');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `dice`
--

CREATE TABLE `dice` (
  `die1` int(11) NOT NULL,
  `die2` int(11) NOT NULL,
  `piece_color` enum('B','W') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `dice`
--

INSERT INTO `dice` (`die1`, `die2`, `piece_color`) VALUES
(1, 1, 'W'),
(1, 2, 'W'),
(1, 3, 'W'),
(1, 4, 'W'),
(1, 5, 'W'),
(1, 6, 'W'),
(2, 1, 'W'),
(2, 2, 'W'),
(2, 3, 'W'),
(2, 4, 'W'),
(2, 5, 'W'),
(2, 6, 'W'),
(3, 1, 'W'),
(3, 2, 'W'),
(3, 3, 'W'),
(3, 4, 'W'),
(3, 5, 'W'),
(3, 6, 'W'),
(4, 1, 'W'),
(4, 2, 'W'),
(4, 3, 'W'),
(4, 4, 'W'),
(4, 5, 'W'),
(4, 6, 'W'),
(5, 1, 'W'),
(5, 2, 'W'),
(5, 3, 'W'),
(5, 4, 'W'),
(5, 5, 'W'),
(5, 6, 'W'),
(6, 1, 'W'),
(6, 2, 'W'),
(6, 3, 'W'),
(6, 4, 'W'),
(6, 5, 'W'),
(6, 6, 'W'),
(1, 1, 'B'),
(1, 2, 'B'),
(1, 3, 'B'),
(1, 4, 'B'),
(1, 5, 'B'),
(1, 6, 'B'),
(2, 1, 'B'),
(2, 2, 'B'),
(2, 3, 'B'),
(2, 4, 'B'),
(2, 5, 'B'),
(2, 6, 'B'),
(3, 1, 'B'),
(3, 2, 'B'),
(3, 3, 'B'),
(3, 4, 'B'),
(3, 5, 'B'),
(3, 6, 'B'),
(4, 1, 'B'),
(4, 2, 'B'),
(4, 3, 'B'),
(4, 4, 'B'),
(4, 5, 'B'),
(4, 6, 'B'),
(5, 1, 'B'),
(5, 2, 'B'),
(5, 3, 'B'),
(5, 4, 'B'),
(5, 5, 'B'),
(5, 6, 'B'),
(6, 1, 'B'),
(6, 2, 'B'),
(6, 3, 'B'),
(6, 4, 'B'),
(6, 5, 'B'),
(6, 6, 'B');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `fr`
--

CREATE TABLE `fr` (
  `id` int(11) NOT NULL,
  `ids` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `fr`
--

INSERT INTO `fr` (`id`, `ids`, `rid`, `type`) VALUES
(1, 1, 2, 1),
(2, 1, 3, 0),
(3, 1, 4, 1),
(4, 5, 1, 1),
(5, 1, 8, 1),
(6, 1, 7, 0),
(7, 0, 1, 0),
(8, 8, 2, 0),
(9, 5, 8, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `game_status`
--

CREATE TABLE `game_status` (
  `status` enum('not active','initialized','started','\nended','aborded') NOT NULL DEFAULT 'not active',
  `p_turn` enum('W','B') DEFAULT NULL,
  `result` enum('B','W','D') DEFAULT NULL,
  `last_change` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `game_status`
--

INSERT INTO `game_status` (`status`, `p_turn`, `result`, `last_change`) VALUES
('aborded', NULL, 'W', '2021-01-06 21:00:15');

--
-- Δείκτες `game_status`
--
DELIMITER $$
CREATE TRIGGER `game_status_update` BEFORE UPDATE ON `game_status` FOR EACH ROW BEGIN
	set NEW.last_change = now();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `lobbys`
--

CREATE TABLE `lobbys` (
  `ids` int(11) NOT NULL,
  `1id` int(11) NOT NULL,
  `2id` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `lobbys`
--

INSERT INTO `lobbys` (`ids`, `1id`, `2id`, `type`) VALUES
(37, 0, 1, 0),
(38, 1, 1, 0),
(39, 8, 1, 0),
(40, 1, 8, 0),
(41, 8, 8, 0),
(42, 1, 8, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `players`
--

CREATE TABLE `players` (
  `username` varchar(20) DEFAULT NULL,
  `piece_color` enum('B','W') NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `last_action` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `players`
--

INSERT INTO `players` (`username`, `piece_color`, `token`, `last_action`) VALUES
('plero', 'B', '9f2ab632468b7ecb73fb500d1acf7afe', NULL),
('plero666', 'W', 'afb0a2b53d88c359190cb23663c0f4dc', NULL);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `password` longtext NOT NULL,
  `online` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `online`, `created_at`) VALUES
(0, 'plero1000', 'plero1000@gmail.com', '$2y$10$rUxKXclkcEVXCCvqFQfS3uCmprgjw/RAcg8zkBUe/lFZg4hSlW39G', 0, '2021-01-06 18:46:34'),
(1, 'plero', 'plero@gmail.com', '$2y$10$PifNOT5ckeV8Rp9CehVhHePtLHFAkEF8bGzJdkc1Bkr.CRwjLFEBS', 1, '2021-01-02 05:41:37'),
(2, 'plero1', 'plero1@gmail.com', '$2y$10$37KdjiPl3lVOen5.Ai6SDufIiw.q0jF.N2F2HuRshnBAFZOZQyVHu', 0, '2021-01-03 01:22:41'),
(3, 'plero2', 'plero2@gmail.com', '$2y$10$X4Rdrc8A8eV5t2ycojgvTubfGkVztoSDfHrAnBVTF.ibf0.FK.3Qm', 0, '2021-01-03 11:34:06'),
(4, 'plero4', 'plero4@gmail.com', '$2y$10$d.2sB/7VvkH8uKC.tvBKMeRAT3c9r9eVcnEU6Hsbt8S2Z.Fqkt4fq', 0, '2021-01-03 11:34:29'),
(5, 'plero5', 'plero5@gmail.com', '$2y$10$xpTvuDHTp4lYs9EQvUDcwOxcID3jNgKGQhJDWpFx.af12FCYbDhlS', 0, '2021-01-03 13:45:58'),
(6, 'plero6', 'plero6@gmail.com', '$2y$10$6.h46ZMwl4hvz8TbdfYKv.uNIRc2G3izpOUeuT6KdC4HQaG4vLg6y', 0, '2021-01-03 13:46:11'),
(7, 'plero10', 'plero10@gmail.com', '$2y$10$dew31.cOUesepxDUR5EZ3OATpYqddVB6FwUcMWD5Dvmum.to/syl6', 0, '2021-01-04 12:58:12'),
(8, 'plero666', 'plero666@gmail.com', '$2y$10$Ol0KWqvCSwyy08jC3ZsC..OJ7OtODHcCQtDglzk4rITIAXqpJxbiK', 1, '2021-01-04 13:05:55');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`x`,`y`);

--
-- Ευρετήρια για πίνακα `board_empty`
--
ALTER TABLE `board_empty`
  ADD PRIMARY KEY (`x`,`y`);

--
-- Ευρετήρια για πίνακα `fr`
--
ALTER TABLE `fr`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `lobbys`
--
ALTER TABLE `lobbys`
  ADD PRIMARY KEY (`ids`);

--
-- Ευρετήρια για πίνακα `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`piece_color`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `fr`
--
ALTER TABLE `fr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT για πίνακα `lobbys`
--
ALTER TABLE `lobbys`
  MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
