  -- USERS
INSERT INTO users (id, name, last_name, email, password, status, role)
  VALUES 
    ('US00000001', 'จอร์น', 'สโนว์', 'john_doe@gmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS',
      'ACTIVE', '2'),
    ('US00000002', 'เดวิด', 'เดชา', 'David_Dang@hotmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS',
      'ACTIVE', '1'),
    ('US00000003', 'สมชาย', 'สายเสมอ', 'somchai_saisamer@hotmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS',
      'ACTIVE', '1'),
    ('US00000004', 'สมัคร', 'สมาน', 'sara123@hotmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS', 
      'ACTIVE', '2'),
    ('US00000005', 'ปิติ', 'ปิโส', 'peter_pit@hotmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS', 
      'ACTIVE', '1'),
    ('US00000006', 'มานะ', 'มาเหอะ', 'mana@gmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS', 
      'ACTIVE', '2'),
    ('US00000007', 'สายสมร', 'เกิดผล', 'saisamon@gmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS', 
      'ACTIVE', '1'),
    ('US00000008', 'พรประเสิท', 'เถิดเทิง', 'porn@gmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS', 
      'ACTIVE', '1'),
    ('US00000009', 'เกียรติขจร', 'อีมรซ่อนผ้า', 'kiet@gmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS', 
      'ACTIVE', '1'),
    ('US00000010', 'ชาติก่อน', 'ตอนบ่าย', 'chart@gmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS', 
      'ACTIVE', '1'),
    ('US00000011', 'บุญเลิศ', 'เตลิด', 'boonlert@gmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS', 
      'ACTIVE', '1'),
    ('US00000012', 'ประสพ', 'อุบัติเหตุ', 'prasob@gmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS', 
      'ACTIVE', '1'),
    ('US00000013', 'ประติ', 'มากรรม', 'prati@gmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS', 
      'ACTIVE', '1');
  
  -- ADMIN
INSERT INTO users (id, name, last_name, email, password, role)
  VALUES 
    ('ADMIN00001', 'ณัฐธนา', 'จิรชัยธำรงศักดิ์', 'slendertao@gmail.com', '$2y$10$MzByxk2TnjfVdh.YSvHWQO8KD2IIKq9m/sy72OslSb7tORdfWRuqS',
      '3');
  
  -- CATEGORIES
INSERT INTO categories (name, description)
  VALUES 
    ('Web Development', 'All knowledges and technologies those involve in Web Development'),
    ('Mobile Applications', 'All knowledges and technologies those involve in Mobile Applications'),
    ('Game Development', 'All knowledges and technologies those involve in Game Development'),
    ('Database', 'All knowledges and technologies those involve in Database'),
    ('Software Testing', 'All knowledges and technologies those involve in Software Testing'),
    ('Tools & Techs', 'All knowledges and technologies those involve in Tools & Techs');

  -- ROLES
INSERT INTO roles (name, description)
  VALUES 
    ('STUDENT', 'Standard User, can enroll courses'),
    ('INSTRUCTOR', 'Standard User, can enroll courses, can create course'),
    ('ADMIN', 'Administrator User, can manage website');
  
  -- STUDENTS
INSERT INTO students (user_id, headline, biography)
  VALUES 
    ('US00000001', 'Studet at Rhajabhat University', 'lorem biography bla...'),
    ('US00000002', 'I am just a student headline', 'lorem biography 22.55bla...'),
    ('US00000003', 'I am no one', 'lorem biographasdasdasdy 22.55bla...'),
    ('US00000004', 'Full Stack Web Developer', 'lorem biography 22bla...'),
    ('US00000005', 'I am just no one', 'lorem biography 33bla...'),
    ('US00000006', 'Engineer at Facebook Corp', 'lorem biography 33bla...'),
    ('US00000007', 'Web developer freelance.', 'lorem biography 33bla...'),
    ('US00000008', 'Security of hotel', 'lorem biography 33bla...'),
    ('US00000009', 'Prince of persia', 'lorem biography 33bla...'),
    ('US00000010', 'Java developer at bootcamp', 'lorem biography 33bla...'),
    ('US00000011', 'English Teacher at School', 'lorem biography 33bla...'),
    ('US00000012', 'Model from Thailand', 'lorem biography 33bla...'),
    ('US00000013', 'Football kicker', 'lorem biography 33bla...');

  -- INSTRUCTORS
INSERT INTO instructors (user_id, paypal_id, website, twitter, facebook, linkedin, youtube, github)
  VALUES 
    ('US00000001', 'paypal88497', 'www.myweb.com', 'twetme', 'personfaceme', 'linkinutlMe', 'YTchan', 'gitmine'),
    ('US00000004', 'paypal9911', 'www.ownerweb.com', 'mytwitacc', 'faceme', 'linkiurl', 'youtubeme', 'megit'),
    ('US00000006', 'paypal024', 'www.belongerweb.com', 'twiturlme', 'fblink', 'linkinemine', 'meYT', 'thegitme');

  -- USERROLES
INSERT INTO userroles (user_id, role_id)
  VALUES 
    ('US00000001', 1),
    ('US00000004', 1),
    ('US00000002', 1),
    ('US00000006', 1),
    ('US00000005', 1),
    ('US00000007', 1),
    ('US00000008', 1),
    ('US00000009', 1),
    ('US00000010', 1),
    ('US00000011', 1),
    ('US00000012', 1),
    ('US00000013', 1),
    ('US00000001', 2),
    ('US00000004', 2),
    ('US00000006', 2),
    ('US00000003', 3);				

  -- PROMOTIONS
INSERT INTO promotions (id, name, description, discount_type, discount_value, start_date, stop_date)
  VALUES 
    ('PRO0000001', 'Cristmas Sale', '20% off cristmas sale in 8th july 2016', 'PERCENT', 20, '2015-08-20', '2016-09-15'),
    ('PRO0000002', 'New Year Sale 2017', '3$ new year sale in 15th march 2017', 'VALUE', 700, '2017-01-10','2017-01-30'),
    ('PRO0000003', 'Web Techs Festival', '50% off sale web technology course', 'PERCENT', 50, '2017-04-30', '2017-07-16');

  -- COURSES
INSERT INTO courses (id, title, slug, subtitle, description, language, level, cover_image, promote_vdo, 
    price, promotion_id, category_id, instructor_id)
  VALUES 
    ('COURSE0001', 'How to FLY in 7 days', 'how-to-fly-in-7-days', 'how to fly easily in only 7 days', 'lorem discription', 'English', 'Low', 'cover_images/sample02.jpg', 'sample-vdo.mp4', 200, 'PRO0000001', 3,'US00000001'),
    ('COURSE0002', 'Learn Java', 'learn-java', 'Learn the Java Basic Level in Short Time','anothoer lorem discription', 'Thai', 'High', 'cover_images/sample02.jpg', 'sample-vdo.mp4', 600, 'PRO0000002', 2, 'US00000004'),
    ('COURSE0003', 'How to diet in 7 days', 'how-to-diet-in-7-days', 'Diet Shortcut the fastest way', 'loreem again descript', 'Thai', 'Medium', 'cover_images/sample03.jpg', 'sample-vdo.mp4', 900, 'PRO0000003', 5, 'US00000001'),
    ('COURSE0004', 'Javascipt Foundation', 'javascript-foundation', 'Learning the foundation of JS', 'loreem blaaa descript', 'Thai', 'Low', 'cover_images/sample03.jpg', 'sample-vdo.mp4', 500, null, 1, 'US00000004'),
    ('COURSE0005', 'AJAX Crash Course', 'ajax-crash-course',  'AJAX Crash Course that makes you understand', 'loreem lol descript', 'English', 'High', 'cover_images/default-cover-image.jpg', 'sample-vdo.mp4', 300, null, 3, 'US00000006');

  -- BENEFITS
INSERT INTO benefits (course_id, sub_number, detail)
  VALUES 
    ('COURSE0001', 1, 'You will know how to fly like a bird'),
    ('COURSE0001', 2, 'You will be light like a feather'),
    ('COURSE0002', 1, 'This course cover a lot of infomation'),
    ('COURSE0002', 2, 'You will understand hard part real quick'),
    ('COURSE0003', 1, 'Diet fast without any effort'),
    ('COURSE0003', 2, 'Diet without hard exercise'),
    ('COURSE0004', 1, 'You will discover alot of basic JS');

  -- TARGETS
INSERT INTO targets (course_id, sub_number, detail)
  VALUES 
    ('COURSE0001', 1, 'Who wants to fly like a bird'),
    ('COURSE0001', 2, 'Who wants to fly like a plane'),
    ('COURSE0002', 1, 'Who wants to expert in Java'),
    ('COURSE0002', 2, 'Who wants to find career in this area'),
    ('COURSE0003', 1, 'Who wants to know more fat'),
    ('COURSE0003', 2, 'Who wants to be thin'),
    ('COURSE0004', 1, 'Who want to know JS'),
    ('COURSE0005', 1, 'Who want to use AJAX in the career');

  -- PREREQUISITES
INSERT INTO prerequisites (course_id, sub_number, detail)
  VALUES 
    ('COURSE0001', 1, 'Have a heart of lion'),
    ('COURSE0001', 2, 'Have a trust to become a bird'),
    ('COURSE0002', 1, 'Know the basics of Java'),
    ('COURSE0002', 2, 'Know about OO-Programming'),
    ('COURSE0003', 1, 'Know to restrain yourself'),
    ('COURSE0003', 2, 'Have a will to become new person'),
    ('COURSE0004', 1, 'Know at least HTML'),
    ('COURSE0005', 1, 'Know basics of API request');

  -- SECTIONS
INSERT INTO sections (course_id, title, objective)
  VALUES 
    ('COURSE0001', 'Introduction: like a bird', 'some objective'),
    ('COURSE0001', 'Prepare yourself to fly', null),
    ('COURSE0002', 'Introduction: greeting', 'for blaaa'),
    ('COURSE0002', 'Install and setup', 'hello there'),
    ('COURSE0003', 'Basic to become new person', 'objec lorem'),
    ('COURSE0003', 'Basic to eat low-fat food', null),
    ('COURSE0004', 'Instuction: JS the new era', 'not much detail...'),
    ('COURSE0005', 'AJAX the modern web app technic', null);

  -- LECTURES
INSERT INTO lectures (id, title, content_type, content_path, content_text, status,
    course_id, sub_number)
  VALUES 
    ('LECTURE001', 'Know the basics', 'VDO', 'lectures/sample-vdo.mp4', null, 'LOCKED', 'COURSE0001', 1),
    ('LECTURE002', 'Know the latters', 'PDF', 'lectures/sample-slide.pdf', null, 'FREE', 'COURSE0001', 1),
    ('LECTURE003', 'Know the 108 methods', 'TXT', null, 'blasdas blasd text', 'LOCKED', 'COURSE0001', 1),
    ('LECTURE004', 'Prepare for 2nd lecture', 'PDF', 'lectures/sample-slide.pdf', null, 'LOCKED', 'COURSE0001', 2),

    ('LECTURE005', 'Greeting Student', 'PDF', 'lectures/sample-slide.pdf', null, 'FREE', 'COURSE0002', 3),
    ('LECTURE006', 'Goodye Student', 'VDO', 'lectures/sample-vdo.mp4', null, 'LOCKED', 'COURSE0002', 4),

    ('LECTURE007', 'HELLO STRANGERS', 'VDO', 'lectures/sample-vdo.mp4', null, 'LOCKED', 'COURSE0003', 5),
    ('LECTURE008', 'SEEYA STRANGERS', 'TXT', null, 'lorem las', 'LOCKED', 'COURSE0003', 6),
    
    ('LECTURE009', 'Lets go together', 'VDO', 'lectures/sample-vdo.mp4', null, 'LOCKED', 'COURSE0004', 7),

    ('LECTURE010', 'This is great', 'VDO', 'lectures/sample-vdo.mp4', null, 'LOCKED', 'COURSE0005', 8);

  -- PURCHASE
INSERT INTO purchase (id, payment_type, student_id)
  VALUES 
    ('PURC000001', 'PAYPAL', 'US00000007'),
    ('PURC000002', 'PAYPAL', 'US00000007'),
    ('PURC000003', 'PAYPAL', 'US00000008'),
    ('PURC000004', 'PAYPAL', 'US00000009'),
    ('PURC000005', 'PAYPAL', 'US00000010'),
    ('PURC000006', 'PAYPAL', 'US00000011');

  -- PURCHASING DETAILS
INSERT INTO purchasedetails (purchase_id, course_id, sold_price, coupon_code, promotion_id)
  VALUES 
    ('PURC000001', 'COURSE0001', 350, null, null),
    ('PURC000001', 'COURSE0002', 340, null, 'PRO0000003'),
    ('PURC000002', 'COURSE0005', 400, null, 'PRO0000001'),

    ('PURC000003', 'COURSE0003', 300, null, null),
    ('PURC000003', 'COURSE0004', 310, null, null),

    ('PURC000004', 'COURSE0004', 450, null, 'PRO0000002'),

    ('PURC000005', 'COURSE0005', 380, null, 'PRO0000003'),
    ('PURC000005', 'COURSE0001', 390, null, 'PRO0000002'),

    ('PURC000006', 'COURSE0004', 410, null, null);

  -- REVIEWS
INSERT INTO reviews (rating, comment, user_id, course_id)
  VALUES 
    (4, null, 'US00000007', 'COURSE0001'),
    (3, 'this course is good', 'US00000007', 'COURSE0002'),
    (3, 'love this course', 'US00000007', 'COURSE0005'),
    
    (5, 'this course is good', 'US00000008', 'COURSE0003'),
    (2, 'not impressive', 'US00000008', 'COURSE0004'),

    (1, 'this course baddd', 'US00000009', 'COURSE0004'),

    (4, 'totally perfect!', 'US00000010', 'COURSE0005'),
    (5, 'I luve IT !!', 'US00000010', 'COURSE0001'),

    (3, 'not bad......', 'US00000011', 'COURSE0004');

  -- WISHLISHS
INSERT INTO wishlists (student_id, course_id)
  VALUES
    ('US00000002', 'COURSE0001'),
    ('US00000002', 'COURSE0002'),
    ('US00000002', 'COURSE0003'),
    ('US00000003', 'COURSE0003');

  --  QUESTIONS
INSERT INTO questions (course_id, student_id, title, content)
  VALUES
    ('COURSE0004', 'US00000008', 'test my 1st question', 'bla bla lorem quest tion asd h adasd fdsf adf.'),
    ('COURSE0004', 'US00000009', 'simple question here', 'wasd aso das dasdla sdas d;asd a;sdasdas'),
    ('COURSE0004', 'US00000011', 'another question hallo', 'sdggoh  gf-g f- -f -fgf dfgs dfgsd');

  -- ANSWERS
INSERT INTO answers (question_id, content, student_id)
  VALUES
    (1, 'anwserrr yoohoo', 'US00000009'),
    (1, 'another answerrr', 'US00000011'),

    (2, 'just don konw answer', 'US00000008'),
    (2, 'ransommmm answerrr', 'US00000011'),

    (3, 'troll answerrr', 'US00000011'),
    (3, 'good answerr', 'US00000009'),
    (3, 'perfect answerrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 'US00000011'),
    (3, 'long answerrrrrrrrrrrrrrasdrrrrrrrrrrrrrrrrradsasdawwdadwsdfsdfsdf', 'US00000009');

  -- FAVORS
INSERT INTO favors (review_id, user_id)
  VALUES
    (2, 'US00000001'),
    (4, 'US00000001'),
    (5, 'US00000001');

-- COUPONS
INSERT INTO coupons (code, discounted_price, stop_date, course_id)
  VALUES
    ('COUPON0001', 310, null, 'COURSE0001'),
    ('COUPON0002', 330, null, 'COURSE0001'),
    ('COUPON0003', 350, null, 'COURSE0001'),
    ('COUPON0004', 325, null, 'COURSE0002'),
    ('COUPON0005', 375, null, 'COURSE0003'),
    ('COUPON0006', 385, null, 'COURSE0003'),
    ('COUPON0007', 260, null, 'COURSE0004'),
    ('COUPON0008', 275, null, 'COURSE0005');

-- ADVERTISEMENTS
INSERT INTO advertisements (course_id, title, detail)
  VALUES
    ('COURSE0001', 'title advert for co01 bla bla', 'detail advert co01 lorem asasd gads dfsb'),
    ('COURSE0004', 'title advert for co02 bla bla', 'detail advert co02 lorem asasd gads dfsb'),
    ('COURSE0005', 'title advert for co03 bla bla', 'detail advert co03 lorem asasd gads dfsb');

-- PROGRESS
INSERT INTO progress (lecture_id, student_id)
  VALUES
    ('LECTURE001', 'US00000007'),
    ('LECTURE003', 'US00000007');

-- COLLECTIONS
INSERT INTO collections (name, note, student_id)
  VALUES
    ('test collect #1', 'to save my to do course for learn', 'US00000007'),
    ('another my fav collections', null, 'US00000007');

-- COLLECTION DETAILS
INSERT INTO collectiondetails (collection_id, course_id)
  VALUES
    (1, 'COURSE0001'),
    (1, 'COURSE0005'),
    (2, 'COURSE0005');

-- ANNOUNCEMENT
INSERT INTO announcement (title, course_id, detail)
  VALUES
    ('announcement #1', 'COURSE0001', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit dicta deserunt libero expedita ipsam illo voluptate amet quod laborum. Ab suscipit totam sunt corrupti vel omnis cupiditate molestias quos quasi!  '),
    ('announcement #2', 'COURSE0001', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit dicta deserunt libero expedita ipsam illo voluptate amet quod laborum. Ab suscipit totam sunt corrupti vel omnis cupiditate molestias quos quasi!  '),
    ('announcement #3', 'COURSE0002', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit dicta deserunt libero expedita ipsam illo voluptate amet quod laborum. Ab suscipit totam sunt corrupti vel omnis cupiditate molestias quos quasi!  '),
    ('announcement #4', 'COURSE0003', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit dicta deserunt libero expedita ipsam illo voluptate amet quod laborum. Ab suscipit totam sunt corrupti vel omnis cupiditate molestias quos quasi!  '),
    ('announcement #5', 'COURSE0004', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit dicta deserunt libero expedita ipsam illo voluptate amet quod laborum. Ab suscipit totam sunt corrupti vel omnis cupiditate molestias quos quasi!  '),    
    ('announcement #6', 'COURSE0004', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit dicta deserunt libero expedita ipsam illo voluptate amet quod laborum. Ab suscipit totam sunt corrupti vel omnis cupiditate molestias quos quasi!  ');

-- BOOKMARKS
INSERT INTO bookmarks (student_id, lecture_id, note)
  VALUES
    ('US00000007', 'LECTURE001', null),
    ('US00000007', 'LECTURE002', 'book marks note asdqef easda sdvdf asd asfasfghrofSOFKASOGKAODFKOAS'),
    ('US00000007', 'LECTURE003', null),
    ('US00000007', 'LECTURE004', 'asdwffhsig srhusigodkoihrsho tdrhdgbbookmarks'),
    ('US00000007', 'LECTURE005', 'wwqqqqwa sdsad sfses  es f'),
    ('US00000007', 'LECTURE006', null),
    ('US00000007', 'LECTURE010', '');
    
-- ABUSE REPORT
INSERT INTO abusereport (course_id, student_id, abuse_type, comment)
  VALUES
    ('COURSE0001', 'US00000007', 'SPAM', null),
    ('COURSE0001', 'US00000003', 'COPY', 'blasd bew f dasf '),
    ('COURSE0002', 'US00000007', 'ABUSE', 'awd gsdpg fpg df'),
    ('COURSE0002', 'US00000005', 'SPAM', null),
    ('COURSE0003', 'US00000008', 'SPAM', null),
    ('COURSE0004', 'US00000002', 'OTHER', 'wdsacxzc');

-- CREATE TABLE Notifications (
--   id                      int           NOT NULL AUTO_INCREMENT,
--   user_id                 varchar(10)   NOT NULL,
--   type                    varchar(10)   NOT NULL,
--   status                  varchar(10)   DEFAULT 'UNREAD',
--   link                    varchar(100),
--   reference_id            varchar(10),
--   created_at   			      datetime 		  DEFAULT CURRENT_TIMESTAMP,

--   CONSTRAINT PK_Notification            PRIMARY KEY (id, user_id),
--   CONSTRAINT FK_UserToNotification      FOREIGN KEY (user_id) REFERENCES Users(id)
-- );
