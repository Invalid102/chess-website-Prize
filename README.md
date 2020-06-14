# chess-website Prize
 Play against a chess computer

 -----------
 notes
 -----------

The main script is chess-board controller.

board_controller(config)

example config:

config = {
        player_colour: "black",
        engine: true,
        game_container: 'game-container',
        size: "600"
    };

player_colour - the orientation of the board, whichever colour the player is ("white","black")
engine - determins whether the engine should play automatically
game_container - the ID of the parent html element to create the board under
size - the size of the board in pixels


PHP

The login script requires a mysql server to be running
Setup:
    create the table (called "accounts")
    This table consists of 
    Auto-increment ID, username, password

    This can be made with the mysql command:

    CREATE TABLE `DB_NAME`.`accounts` (
        `ID` INT NULL AUTO_INCREMENT,
        `username` VARCHAR(45) NULL,
        `password` VARCHAR(60) NULL,
        PRIMARY KEY (`ID`)
    );

    Then edit the authenticate.php file, on line 5.
    Here replace the strings with their appropriate values for your server.
    e.g.

    $link = mysqli_connect('localhost', 'root', 'password1234', 'main_database');


 ---------------------------------------------------
 CREDIT:
 ---------------------------------------------------
 LOGIC-chessboard.js :

 Copyright (c) 2020, Jeff Hlywa (jhlywa@gmail.com)
 https://github.com/jhlywa/chess.js

----------------------------------------------------

 GUI-chessboard.js :

 Copyright (c) 2019, Chris Oakman
 https://chessboardjs.com/