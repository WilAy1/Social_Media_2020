
createTable('trending',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             user VARCHAR(32) NOT NULL,
             heading TEXT(150) NOT NULL,
             content TEXT NOT NULL,
             pnc INT NOT NULL,
             pnl INT NOT NULL,
             timeofpost INT NOT NULL
             ');