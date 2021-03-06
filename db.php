<?php 
     require_once 'connect.php';

     createTable('members',

                 'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
                 firstname VARCHAR(20),
                 surname VARCHAR(20),
                 middlename VARCHAR(20) NOT NULL,
                 email TEXT,
                 pnumber VARCHAR(11) NOT NULL DEFAULT 0,
                 user VARCHAR(32),
                 pass VARCHAR(32),
                 bd_day VARCHAR(10),
                 bd_month VARCHAR(13),
                 bd_year VARCHAR(5),
                 institution VARCHAR(40),
                 status VARCHAR(2),
                 course VARCHAR(50),
                 group1 INT(1) NOT NULL DEFAULT "1" ,
                 sex VARCHAR(2),
                 hash VARCHAR(32) NOT NULL,
                 verifycode INT(6) NOT NULL,
                 country TEXT(40) NOT NULL,
                 ipaddress VARCHAR(20) NOT NULL,
                 loginip VARCHAR(20) NOT NULL,
                 datetimeofcreation DATETIME,
                 browser VARCHAR(50),
                 devicetype VARCHAR(12),
                 active INT(1) NOT NULL DEFAULT "0",
                 activatetime INT(11) NOT NULL,
                 activatexpiretime INT(11) NOT NULL,
                 lastactivitytime INT NOT NULL,
                 lastlogin INT NOT NULL,
                 lastlogout INT NOT NULL,
                 about VARCHAR(7000) NULL,
                 aboutdate INT NOT NULL,
                 userprofilecode VARCHAR(32) NOT NULL,
                 psdhd VARCHAR(32) NOT NULL,
                 fgtpasscode INT(6) NOT NULL,
                 interests TEXT NOT NULL,
                 INDEX(userprofilecode(32)),
                 INDEX(user(6))'
               );
/*
               video-setting: 1->do not autoplay, 2->autoplay
               image-setting: 1->do not save data, 2->save data
               notifications: 1,0->do not auto delete, [2, days]->auto delete after how many days
               darkmode 1->darkmode, 2->no darkmode, 3->auto darkmode
               r_country 1->recommend from country, 2-> do not recommend from country
               r_interest 1->recommend interests to follow, 2-> do not recommend interests to follow, 3->minimize rcommendation
               d_saved 1,days->Delete saved posts after x-days, [2,0]-> do not delete saved posts 
               ac_manage 1->account not disabled, 2->account disabled
               s_svs (show_story_views) 1->true, 2->false,
               d_tagsuggestions (show suggestions on @ and # input) 1->true, 2->false
               others 1->display, 2->to friends, 3->do not display
*/
createTable('settings',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             user VARCHAR(32) NOT NULL,
             darkmode INT(1) NOT NULL,
             notifications VARCHAR(40) NOT NULL, 
             rcountrypost INT(1) NOT NULL,
             rcountryuser INT(1) NOT NULL,
             rinterest INT(1) NOT NULL,
             videosetting INT(1) NOT NULL,
             imagesetting INT(1) NOT NULL,
             dsaved VARCHAR(40) NOT NULL,
             acmanage INT(1) NOT NULL,
             ssvs INT(1) NOT NULL,
             dtags INT(1) NOT NULL,
             number INT(1) NOT NULL,
             sex INT(1) NOT NULL,
             email INT(1) NOT NULL,
             website INT(1) NOT NULL,
             dateofbirth INT(1) NOT NULL,
             ucolor VARCHAR(7) NOT NULL
             ');
createTable('friends',
                'firstname VARCHAR(30),
                surname VARCHAR(30),
                user VARCHAR(32),
                frienduser VARCHAR(100),
                friendfirstname VARCHAR(20),
                friendsurname VARCHAR(20)');
createTable('followstatus',
             'user VARCHAR(32),
             type VARCHAR(30),
             friend VARCHAR(32),
             timeoffollow INT NOT NULL');
createTable('spamlist',
            'user VARCHAR(32),
            reporteduser VARCHAR(32),
            typeofspam INT(1),
            description TEXT');
createTable('eduposts',
                'user VARCHAR(32) NOT NULL,
                taggedusers VARCHAR(10000) NOT NULL,
                id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                pstcont TEXT NOT NULL,
                 pstst INT(11)NOT NULL,
                 timeofupdate INT(11) NOT NULL,
                 isshare INT(1) NOT NULL,
                 sharedby VARCHAR(32) NOT NULL,
                 sharedpostid INT NOT NULL,
                 sharedpstcont TEXT NOT NULL,
                 restricted INT(1) NOT NULL,
                 pnl INT NOT NULL DEFAULT 0,
                 tun INT NOT NULL DEFAULT 0,
                 tdn INT NOT NULL DEFAULT 0,
                 pnc INT NOT NULL, 
                 pinterest TEXT NOT NULL');
createTable('socposts',
                 'user VARCHAR(32) NOT NULL,
                  taggedusers VARCHAR(10000) NOT NULL DEFAULT 0,
                  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                  pstcont TEXT NOT NULL,
                  pstst INT(11)NOT NULL,
                  timeofupdate INT(11) NOT NULL,
                  isshare INT(1) NOT NULL,
                  sharedby VARCHAR(32) NOT NULL,
                  sharedpostid INT NOT NULL,
                  sharedpstcont TEXT NOT NULL,
                  restricted INT(1) NOT NULL,
                  pnl INT NOT NULL DEFAULT "0",
                  tln INT NOT NULL DEFAULT 0,
                  tdn INT NOT NULL DEFAULT 0,
                  pnc INT NOT NULL,
                  pinterest TEXT NOT NULL');
createTable('educomments',
                'user VARCHAR(32) NOT NULL,
                 id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                 postid INT ZEROFILL NOT NULL REFERENCES eduposts(id),
                 cmt TEXT NOT NULL,
                 timeofcomment INT NOT NULL,
                 tnc INT(11) NOT NULL,
                 tun INT NOT NULL,
                 tdn INT NOT NULL');
createTable('soccomments',
                 'user VARCHAR(32) NOT NULL,
                  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                  postid INT ZEROFILL NOT NULL REFERENCES socposts(id),
                  cmt TEXT NOT NULL,
                  timeofcomment INT(11) NOT NULL,
                  tnc INT(11) NOT NULL,
                  tln INT NOT NULL');
createTable('votes',
                'user VARCHAR(32) NOT NULL,
                 voted TEXT,
                 id INT ZEROFILL NOT NULL REFERENCES eduposts(id),
                 timeofvote INT NOT NULL'
                );
createTable('commentvotes',
              'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
               user VARCHAR(32) NOT NULL,
               voted TEXT,
               postid INT NOT NULL,
               commentid INT NOT NULL,
               iscommentreply INT(1) NOT NULL,
               replyid INT NOT NULL,
               timeofcommentvote INT NOT NULL
               ');
createTable('loves',
                 'user VARCHAR(32) NOT NULL,
                  loved TEXT(10),
                  id INT ZEROFILL NOT NULL REFERENCES socposts(id),
                  timeoflike INT NOT NULL'
                );
createTable('commentloves',
              'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
               user VARCHAR(32) NOT NULL,
               loved TEXT,
               postid INT NOT NULL,
               commentid INT NOT NULL,
               iscommentreply INT(1) NOT NULL,
               replyid INT NOT NULL,
               timeofcommentlike INT NOT NULL
               ');
createTable('notifications',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             user VARCHAR(32),
             usertobenotified VARCHAR(32),
             postid INT NOT NULL,
             notheading TEXT NOT NULL,
             notcontent TEXT NOT NULL,
             hidenot INT DEFAULT 0,
             notlink TEXT,
             readalready INT(1) NOT NULL,
             timeofnot INT DEFAULT 0
             ');
createTable('studentsconnectadmin',
             'fullname VARCHAR(50),
             db INT(2),
             mb VARCHAR(15),
             yb INT(4),
             password VARCHAR(100),
             email VARCHAR(100)');
createTable('replyeducomments',
            'user VARCHAR(32) NOT NULL,
            id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            postid INT ZEROFILL NOT NULL REFERENCES eduposts(id),
            cmtid INT ZEROFILL NOT NULL REFERENCES educomments(id),
            reply TEXT NOT NULL,
            timeofreply INT NOT NULL,
            tnr INT NOT NULL,
            tun INT NOT NULL,
            tdn INT NOT NULL');
createTable('replysoccomments',
            'user VARCHAR(32) NOT NULL,
            id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            postid INT ZEROFILL NOT NULL REFERENCES socposts(id),
            cmtid INT ZEROFILL NOT NULL REFERENCES soccomments(id),
            reply TEXT NOT NULL,
            timeofreply INT NOT NULL,
            tnr INT NOT NULL,
            tln INT NOT NULL');
createTable('replyreplieseducomments',
            'user VARCHAR(32) NOT NULL,
            id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            postid INT ZEROFILL NOT NULL REFERENCES eduposts(id),
            cmtid INT ZEROFILL NOT NULL REFERENCES educomments(id),
            replyid INT ZEROFILL NOT NULL REFERENCES replyeducomments(id),
            reply TEXT NOT NULL,
            timeofreply INT NOT NULL,
            tnr INT NOT NULL,
            tun INT NOT NULL,
            tdn INT NOT NULL');
createTable('replyrepliessoccomments',
            'user VARCHAR(32) NOT NULL,
            id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            postid INT ZEROFILL NOT NULL REFERENCES socposts(id),
            cmtid INT ZEROFILL NOT NULL REFERENCES soccomments(id),
            replyid INT ZEROFILL NOT NULL REFERENCES replysoccomments(id),
            reply TEXT NOT NULL,
            timeofreply INT NOT NULL,
            tnr INT NOT NULL,
            tln INT NOT NULL');
/*createTable('csmgroupmessages',
             'messageid INT AUTO_INCREMENT PRIMARY KEY,
             user VARCHAR(32) NOT NULL,
             message TEXT NOT NULL,
             timeofmessage INT NOT NULL');
createTable('phmgroupmessages',
             'messageid INT AUTO_INCREMENT PRIMARY KEY,
             user VARCHAR(32) NOT NULL,
             message TEXT NOT NULL,
             timeofmessage INT NOT NULL');
createTable('mbbsgroupmessages',
             'messageid INT AUTO_INCREMENT PRIMARY KEY,
             user VARCHAR(32) NOT NULL,
             message TEXT NOT NULL,
             timeofmessage INT NOT NULL');
createTable('csegroupmessages',
             'messageid INT AUTO_INCREMENT PRIMARY KEY,
             user VARCHAR(32) NOT NULL,
             message TEXT NOT NULL,
             timeofmessage INT NOT NULL');
createTable('lawgroupmessages',
             'messageid INT AUTO_INCREMENT PRIMARY KEY,
             user VARCHAR(32) NOT NULL,
             messagwe TEXT NOT NULL,
             timeofmessage INT NOT NULL');*/
createTable('messages',
            'messageid INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            sender VARCHAR(32) NOT NULL,
            receiver VARCHAR(32) NOT NULL,
            message TEXT,
            timeofmessage INT NOT NULL,
            hasfile INT(1) NOT NULL,
            hasread INT(1) NOT NULL,
            isreply INT(1) NOT NULL,
            replyingto INT NOT NULL');
createTable('messagesbase',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            fone VARCHAR(32) NOT NULL,
            ftwo VARCHAR(32) NOT NULL,
            lasttimeofmessage INT NOT NULL,
            numberofmessages INT NOT NULL');
createTable('deletedmessages',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             messageid INT NOT NULL,
             byuser VARCHAR(32) NOT NULL,
             timeofdelete INT NOT NULL');
createTable('selfgroups',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              creator VARCHAR(32) NOT NULL,
              nameofgroup TEXT(40) NOT NULL,
              description TEXT(250) NOT NULL,
              numberofmembers INT(3) NOT NULL,
              type INT(1) NOT NULL,
              timeofcreation INT NOT NULL,
              lastmessagetime INT NOT NULL,
              grouplinkhash VARCHAR(32) NOT NULL,
              grouppassword VARCHAR(10) NOT NULL');
createTable('groupmembership',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             user VARCHAR(32),
             membership INT(1), 
             groupid INT ZEROFILL NOT NULL REFERENCES selfgroups(id),
             isadmin INT(1) NOT NULL,
             joined INT NOT NULL,
             lastmessageongroup INT NOT NULL');
createTable('groupmessages',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              user VARCHAR(32) NOT NULL,
              groupid INT ZEROFILL NOT NULL REFERENCES selfgroups(id),
              message TEXT,
              timeofmessage INT NOT NULL,
              hasfile INT(1) NOT NULL,
              isreply INT(1) NOT NULL,
              replying INT NOT NULL');
// ACTIONS
/* 1. EDUPOST UPVOTE
   2. EDUPOST DOWNVOTE
   3. SOCPOST LOVE
   4. EDUPOST COMMENT
   5. SOCPOST COMMENT
   6. SEARCH
   7. FOLLOW
   8. UNFOLLOW
   9. BLOCKED
   10. REPORT
   11. PROFILE (ABOUT, NAME, DOB)
   12. POLLED
   13. SAVED
   */
createTable('actions',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              user VARCHAR(32) NOT NULL,
              oid INT NOT NULL,
              timeofaction INT NOT NULL
              ');
createTable('recentsearches',
              'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
               user VARCHAR(32) NOT NULL,
               search TEXT NOT NULL,
               timeofsearch INT NOT NULL');
createTable('hashtags',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             user VARCHAR(32) NOT NULL,
             hashtag TEXT NOT NULL,
             type INT(1) NOT NULL,
             timefh INT NOT NULL
             ');
createTable('hashtagsbase',
            'id INT AUTO_INCREMENT PRIMARY KEY,
             createdby VARCHAR(32) NOT NULL,
             tagname TEXT NOT NULL,
             type INT(1) NOT NULL,
             numberofusages INT NOT NULL,
             started INT NOT NULL');
createTable('postviews',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              views INT NOT NULL');
createTable('spostviews',
              'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
               views INT NOT NULL');              
createTable('forums',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             nameofforum VARCHAR(250) NOT NULL,
             motto TEXT(250) NOT NULL,
             about TEXT(250) NOT NULL,
             purpose VARCHAR(50) NOT NULL,
             typeofforum INT(1) NOT NULL,
             locked INT (1)NOT NULL,
             createdby VARCHAR(32) NOT NULL,
             created INT NOT NULL,
             numberofmembers INT NOT NULL
             ');
#locked; if forum is locked only admins will be able to post             
#type of forum; if forum is private member needs to be acknoledged to enter, else entering forum is direct             
# position in forum is admin or not
# isacknoledged values, 0 = not a member(needs acknoledgement), 1 = a member, 2 = was invited, 3 = blocked
createTable('forummembers',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              forumid INT ZEROFILL NOT NULL REFERENCES forums(id),
              user VARCHAR(32) NOT NULL,
              positioninforum INT(1) NOT NULL,
              datejoined INT NOT NULL,
              isacknoledged INT(1) NOT NULL
              ');
createTable('forumposts',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             user VARCHAR(32) NOT NULL,
             forumid INT ZEROFILL NOT NULL REFERENCES forums(id),
             contentofpost TEXT NOT NULL,
             dateofpost INT NOT NULL,
             tnuvotes INT NOT NULL,
             tndvotes INT NOT NULL,
             tncomments INT NOT NULL');
createTable('forumpostviews',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              views INT NOT NULL');
createTable('forumpostsvotes',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              user VARCHAR(32) NOT NULL,
              fid INT NOT NULL,
              tov VARCHAR(10) NOT NULL,
              ispostvote INT(1) NOT NULL,
              postid INT NOT NULL,
              iscommentvote INT(1) NOT NULL,
              commentid INT NOT NULL,
              isreplycomment INT(1) NOT NULL,
              replycommentid INT NOT NULL,
              isreplyreply INT(1) NOT NULL,
              replyreplyid INT NOT NULL,
              isreplyreplyreply INT(1) NOT NULL,
              replyreplyreplyid INT NOT NULL,
              timeofvote INT NOT NULL');
createTable('classes',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              fid INT NOT NULL,
              ccreated VARCHAR(32) NOT NULL,
              classname TEXT(100) NOT NULL,
              classdetails TEXT(250) NOT NULL,
              locked INT(1) NOT NULL,
              numberofstudents INT NOT NULL,
              dateofcreation INT NOT NULL');
createTable('classmembers',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             cid INT NOT NULL,
             fid INT NOT NULL,
             user VARCHAR(32) NOT NULL,
             positioninclass INT(1) NOT NULL,
             isacknoledged INT(1) NOT NULL,
             blocked INT NOT NULL,
             numberofmessages INT NOT NULL,
             datejoined INT NOT NULL');
createTable('classmessages',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              cid INT NOT NULL,
              fid INT NOT NULL,
              user VARCHAR(32) NOT NULL,
              message TEXT NOT NULL,
              timeofmessage INT NOT NULL,
              hasfile INT(1) NOT NULL');
createTable('polls',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              pid INT NOT NULL,
               pstst INT NOT NULL,
               opt1 VARCHAR(20) NOT NULL,
               opt2 VARCHAR(20) NOT NULL,
               opt3 VARCHAR(20) NOT NULL,
               opt4 VARCHAR(20) NOT NULL,
               o1clicks INT NOT NULL,
               o2clicks INT NOT NULL,
               o3clicks INT NOT NULL,
               o4clicks INT NOT NULL,
               timestarted INT NOT NULL,
               timetoend INT NOT NULL');
createTable('pollbase',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              user VARCHAR(32) NOT NULL,
              clicked INT(1) NOT NULL,
              pid INT NOT NULL,
              pstst INT(1) NOT NULL');
createTable('forumpolls',
              'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
               pid INT NOT NULL,
                pstst INT NOT NULL,
                opt1 VARCHAR(20) NOT NULL,
                opt2 VARCHAR(20) NOT NULL,
                opt3 VARCHAR(20) NOT NULL,
                opt4 VARCHAR(20) NOT NULL,
                o1clicks INT NOT NULL,
                o2clicks INT NOT NULL,
                o3clicks INT NOT NULL,
                o4clicks INT NOT NULL,
                timestarted INT NOT NULL,
                timetoend INT NOT NULL');
 createTable('forumpollbase',
              'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
               user VARCHAR(32) NOT NULL,
               clicked INT(1) NOT NULL,
               pid INT NOT NULL,
               pstst INT(1) NOT NULL');
createTable('forumscomment',
            'user VARCHAR(32) NOT NULL,
            id INT AUTO_INCREMENT PRIMARY KEY,
            pid INT NOT NULL,
            fid INT NOT NULL,
            cmt TEXT NOT NULL,
            timeofcomment INT NOT NULL,
            tnc INT NOT NULL,
            tun INT NOT NULL,
            tdn INT NOT NULL');
createTable('messagesforusers',
            'user VARCHAR(32) NOT NULL,
             message TEXT NOT NULL,
             dateofmessage INT NOT NULL');
createTable('trending',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             user VARCHAR(32) NOT NULL,
             heading TEXT(150) NOT NULL,
             content TEXT NOT NULL,
             pnc INT NOT NULL,
             pnl INT NOT NULL,
             timeofpost INT NOT NULL
             ');
createTable('trendingloves',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             tid INT NOT NULL,
             user INT NOT NULL,
             timeoflove INT NOT NULL');
createTable('trendingcomments',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             tid INT NOT NULL,
             comment TEXT NOT NULL,
             tnr INT NOT NULL,
             commentloves INT NOT NULL,
             iscreply INT(1) NOT NULL,
             rcid INT NOT NULL,
             rtnr INT NOT NULL,
             isccreply INT NOT NULL,
             rid INT NOT NULL,
             crcid INT NOT NULL,
             crtnr INT NOT NULL,
             timeofcomment INT NOT NULL');
createTable("discover",
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             startedby VARCHAR(32) NOT NULL,
             discovername TEXT(200) NOT NULL,
             discoverusername VARCHAR(40) NOT NULL,
             discoverabout TEXT NOT NULL,
             numberofposts INT NOT NULL,
             numberoffollowers INT NOT NULL,
             datecreated INT NOT NULL,
             numberofvisits INT NOT NULL,
             relatedto TEXT NOT NULL,
             sl TEXT NOT NULL');
createTable('discoverfollowers',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             user VARCHAR(32) NOT NULL,
             discoverid INT NOT NULL,
             numberofposts INT NOT NULL,
             numberofcomments INT NOT NULL,
             numberoflikes INT NOT NULL,
             isadmin INT NOT NULL,
             joined INT NOT NULL');
//rating type is for rate, upvote or love
createTable('discoverposts', 
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             discoverid INT NOT NULL,
             postheading TEXT NOT NULL,
             postcontent TEXT NOT NULL,
             ratingtype INT NOT NULL,
             rating VARCHAR(100) NOT NULL,
             timeposted INT NOT NULL,
             isedited INT(1) NOT NULL,
             edited INT NOT NULL,
             numberofvisits INT NOT NULL,
             tag TEXT NOT NULL');
createTable('discoverpostsvisits',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             user VARCHAR(32) NOT NULL,
             timeofvisit INT NOT NULL,
             devicetype TEXT NOT NULL,
             location TEXT NOT NULL,
             browser TEXT NOT NULL');
createTable('discoverratings', 
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              user VARCHAR(32) NOT NULL,
              type TEXT NOT NULL,
              timeofrate INT NOT NULL');
createTable('ads',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             entity VARCHAR(100) NOT NULL,
             adtype INT NOT NULL,
             ispostid INT(1) NOT NULL,
             extracontent TEXT NOT NULL,
             speciallink TEXT NOT NULL,
             clicks INT NOT NULL,
             piority INT(1) NOT NULL,
             paymenttype INT NOT NULL,
             expired INT(1) NOT NULL,
             ordertime INT NOT NULL,
             region TEXT NOT NULL,
             sptags TEXT NOT NULL,
             expiretime INT NOT NULL');
createTable('deactivated',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             user VARCHAR(32) NOT NULL,
             deactivated INT(1) NOT NULL,
             timeofd INT NOT NULL');
createTable('stories',
            'user VARCHAR(32) NOT NULL,
             id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             caption TEXT NOT NULL,
             seen INT NOT NULL,
             timeofupdate INT NOT NULL');
createTable('saved',
             'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
              user VARCHAR(32) NOT NULL,
              type TEXT NOT NULL,
              saveid INT NOT NULL,
              caption TEXT NOT NULL,
              splink TEXT NOT NULL,
              timeofsave INT NOT NULL');
createTable('blocked',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             user VARCHAR(32) NOT NULL,
             touser VARCHAR(32) NOT NULL,
             timeofblockage INT NOT NULL');
createTable('recommendations',
            'id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
             user VARCHAR(32) NOT NULL,
             rd VARCHAR(32) NOT NULL,
             timeofr INT NOT NULL');
?>