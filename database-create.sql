DROP TABLE IF EXISTS progress;
DROP TABLE IF EXISTS benefits;
DROP TABLE IF EXISTS targets;
DROP TABLE IF EXISTS prerequisites;
DROP TABLE IF EXISTS bookmarks;
DROP TABLE IF EXISTS lectures;
DROP TABLE IF EXISTS sections;

DROP TABLE IF EXISTS announcement;
DROP TABLE IF EXISTS advertisements;
DROP TABLE IF EXISTS purchasedetails;
DROP TABLE IF EXISTS purchase;
DROP TABLE IF EXISTS wishlists;
DROP TABLE IF EXISTS coupons;
DROP TABLE IF EXISTS collectiondetails;
DROP TABLE IF EXISTS collections;
DROP TABLE IF EXISTS favors;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS abusereport;
DROP TABLE IF EXISTS answers;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS courses;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS promotions;

DROP TABLE IF EXISTS notifications;
DROP TABLE IF EXISTS userroles;
DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS instructors;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS roles;

CREATE TABLE users (
  id 						          varchar(10) 	NOT NULL,
  name 				            varchar(50) 	NOT NULL,
  last_name 				      varchar(50),
  email 					        varchar(50) 	NOT NULL,
  password 					      varchar(60)   NOT NULL,
  status 			            varchar(10) 	DEFAULT 'ACTIVE',
  role                    varchar(10)   DEFAULT '1',
  remember_token          varchar(100)  NULL,
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT UC_User                    UNIQUE (email),
  CONSTRAINT PK_User                    PRIMARY KEY (id)
);

CREATE TABLE categories (
	id 						          int				    NOT NULL AUTO_INCREMENT,
	name 					          varchar(50)		NOT NULL,
	description				      varchar(100),
  created_at   			      datetime 		  DEFAULT CURRENT_TIMESTAMP,

	CONSTRAINT UC_Category                UNIQUE (name),
  CONSTRAINT PK_Category                PRIMARY KEY (id)
);

CREATE TABLE roles (
	id 						          int				    NOT NULL AUTO_INCREMENT,
	name 					          varchar(50)		NOT NULL,
	description				      varchar(100),
  created_at  			      datetime 		  DEFAULT CURRENT_TIMESTAMP,
  
	CONSTRAINT UC_Role                    UNIQUE (name),
  CONSTRAINT PK_Role                    PRIMARY KEY (id)
);

CREATE TABLE promotions (
	id 						          varchar(10) 	NOT NULL,
	name					          varchar(50)		NOT NULL,
	description				      varchar(100),
  discount_type           varchar(10)   NOT NULL,
  discount_value          int           NOT NULL,
  start_date              date          NOT NULL,
  stop_date               date          NOT NULL,
  status                  varchar(10)   DEFAULT 'DISABLED',
  created_at   			      datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Role                    PRIMARY KEY (id)
);

CREATE TABLE students (
  user_id 						    varchar(10) 	NOT NULL,
  photo 					        varchar(100)  DEFAULT 'avatars/default-user.jpg',
  headline 				        varchar(50),
  biography 				      varchar(1000),
  allow_pub_profile 			varchar(1) 		DEFAULT 'Y',
  allow_pub_course 			  varchar(1) 		DEFAULT 'Y',
  allow_pro_email        	varchar(1) 		DEFAULT 'Y',
  allow_announcement    	varchar(1) 		DEFAULT 'Y',
  allow_imp_update 	      varchar(1) 		DEFAULT 'Y',
  created_at    		      datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Student                 PRIMARY KEY (user_id),
  CONSTRAINT FK_UserToStudent           FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE instructors (
	user_id 						    varchar(10) 	NOT NULL,
	paypal_id				        varchar(50)		NOT NULL,
	website  				        varchar(50),
  twitter 				        varchar(50),
  facebook 				        varchar(50),
  linkedin 				        varchar(50),
  youtube 				        varchar(50),
  github 					        varchar(50),
  allow_pub_teaching 		  varchar(1) 		DEFAULT 'Y',
  created_at   			      datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Instructor              PRIMARY KEY (user_id),
  CONSTRAINT FK_UserToInstructor        FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE courses (
	id 						          varchar(10) 	NOT NULL,
	title					          varchar(50) 	NOT NULL,
	slug					          varchar(50) 	NOT NULL,
	subtitle				        varchar(50),
	description				      varchar(1000),
	language				        varchar(30),
	level					          varchar(30),
	cover_image					    varchar(100)  DEFAULT 'cover_images/default-cover-image.jpg',
	promote_vdo			      	varchar(100),
	status			            varchar(10) 	DEFAULT 'DRAFT',
  price                   decimal(15,2) DEFAULT 0,
  license                 varchar(10)   DEFAULT 'NOT',
  admin_feedback          varchar(500),
	promotion_id            varchar(10),
	category_id             int,
	instructor_id           varchar(10)   NOT NULL,
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT UC_Courses                 UNIQUE (title, slug),
  CONSTRAINT PK_Course                  PRIMARY KEY (id),
  CONSTRAINT FK_PromotionToCourse       FOREIGN KEY (promotion_id) REFERENCES promotions(id),
  CONSTRAINT FK_CategoryToCourse        FOREIGN KEY (category_id) REFERENCES categories(id),
  CONSTRAINT FK_InstructorToCourse      FOREIGN KEY (instructor_id) REFERENCES users(id)
);

CREATE TABLE benefits (
	course_id 						  varchar(10) 	NOT NULL,
  sub_number              int				    NOT NULL,
	detail				          varchar(100) 	NOT NULL,
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Benefit                 PRIMARY KEY (sub_number, course_id),
  CONSTRAINT FK_CourseToBenefits        FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE targets (
	course_id 					    varchar(10) 	NOT NULL,
  sub_number              int				    NOT NULL,
	detail				          varchar(100) 	NOT NULL,
  created_at   			      datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_TargetStudent           PRIMARY KEY (sub_number, course_id),
  CONSTRAINT FK_CourseToTargetStudents  FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE prerequisites (
	course_id						    varchar(10) 	NOT NULL,
  sub_number              int				    NOT NULL,
	detail				          varchar(100) 	NOT NULL,
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Prerequisite            PRIMARY KEY (sub_number, course_id),
  CONSTRAINT FK_CourseToPrerequisites   FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE sections (
  sub_number              int				    NOT NULL AUTO_INCREMENT,
  title				            varchar(50) 	NOT NULL,
  objective				        varchar(50),
  course_id 						  varchar(10) 	NOT NULL,
  created_at   			      datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Section                 PRIMARY KEY (sub_number),
  CONSTRAINT FK_CourseToSection         FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE lectures (
  id                      varchar(10)   NOT NULL,
  title				            varchar(50) 	NOT NULL,
  content_type            varchar(10),
  content_path            varchar(100),
  content_text            text(9999),
  status                  varchar(10)   DEFAULT 'LOCKED',
  course_id 						  varchar(10) 	NOT NULL,
  sub_number              int				    NOT NULL,
  created_at   			      datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Lecture                 PRIMARY KEY (id),
  CONSTRAINT FK_SectionToLecture        FOREIGN KEY (course_id, sub_number) REFERENCES sections(course_id, sub_number)
);

CREATE TABLE progress (
  student_id              varchar(10)   NOT NULL,
  lecture_id              varchar(10)   NOT NULL,
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Progress                PRIMARY KEY (student_id, lecture_id),
  CONSTRAINT FK_StudentToProgress       FOREIGN KEY (student_id) REFERENCES users(id),
  CONSTRAINT FK_LectureToProgress       FOREIGN KEY (lecture_id) REFERENCES lectures(id)
);

CREATE TABLE userroles (
	user_id 						    varchar(10)	  NOT NULL,
	role_id 					      int		        NOT NULL,
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_UserRole                PRIMARY KEY (user_id, role_id),
  CONSTRAINT FK_UserToUserRole          FOREIGN KEY (user_id) REFERENCES users(id),
  CONSTRAINT FK_RoleToUserRole          FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE reviews (
  id                      int           NOT NULL AUTO_INCREMENT,
  rating                  int           NOT NULL,
  comment                 varchar(500),
  user_id 						    varchar(10)	  NOT NULL,
	course_id 					    varchar(10)	  NOT NULL,
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Review                  PRIMARY KEY (id),
  CONSTRAINT FK_UserToReview            FOREIGN KEY (user_id) REFERENCES users(id),
  CONSTRAINT FK_CourseToReview          FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE favors (
  review_id               int	          NOT NULL,
	user_id                 varchar(10)   NOT NULL,
  created_at   			      datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Favor                   PRIMARY KEY (review_id, user_id),
  CONSTRAINT FK_ReviewToFavor           FOREIGN KEY (review_id) REFERENCES reviews(id),
  CONSTRAINT FK_UserToFavor             FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE collections (
  id                      int           NOT NULL AUTO_INCREMENT,
  name                    varchar(30)   NOT NULL,
  note                    varchar(50),
	student_id              varchar(10)   NOT NULL,
  created_at   			      datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Collection              PRIMARY KEY (id),
  CONSTRAINT FK_UserToCollection        FOREIGN KEY (student_id) REFERENCES users(id)
);

CREATE TABLE collectiondetails (
  collection_id           int           NOT NULL,
  course_id               varchar(10)   NOT NULL,
  created_at     			    datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_CollectionDetail        PRIMARY KEY (collection_id, course_id),
  CONSTRAINT FK_ColToColDetail          FOREIGN KEY (collection_id) REFERENCES collections(id),
  CONSTRAINT FK_CourseToColDetail       FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE wishlists (
  student_id              varchar(10)   NOT NULL,
  course_id               varchar(10)   NOT NULL,
  created_at  			      datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Wishlist                PRIMARY KEY (student_id, course_id),
  CONSTRAINT FK_UserToWishlist          FOREIGN KEY (student_id) REFERENCES users(id),
  CONSTRAINT FK_CourseToWishlist        FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE coupons (
  code                    varchar(20)   NOT NULL,
  discounted_price        int           NOT NULL,
  quantity                int           DEFAULT 1,
  status                  varchar(10)   DEFAULT 'ENABLED',
  stop_date               date,
  course_id               varchar(10)   NOT NULL,
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,     

  CONSTRAINT PK_Coupons                 PRIMARY KEY (code),
  CONSTRAINT FK_CourseToCoupon          FOREIGN KEY (course_id) REFERENCES courses(id) 
);

CREATE TABLE purchase (
  id                      varchar(10)   NOT NULL,
  invoice                 varchar(30),
  payment_type            varchar(30)   NOT NULL,
  status                  varchar(10)   DEFAULT 'completed',
  paypal_pay_id           varchar(50),
  paypal_paid_date        datetime,
  paypal_payer_id         varchar(50),
  paypal_payer_email      varchar(50),
  paypal_payer_firstname  varchar(50),
  paypal_payer_middlename varchar(50),
  paypal_payer_lastname   varchar(50),
  paypal_paid_amount      decimal(15,2),
  paypal_custom           varchar(100),
  paypal_trans_id         varchar(50),
  student_id              varchar(10)   NOT NULL,
  created_at   			      datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Purchase                PRIMARY KEY (id),
  CONSTRAINT FK_UserToPurchase          FOREIGN KEY (student_id) REFERENCES users(id)
);

CREATE TABLE purchasedetails (
  purchase_id             varchar(10)   NOT NULL,
  course_id               varchar(10)   NOT NULL,
  sold_price              int           NOT NULL,
  status                  varchar(10)   DEFAULT 'PAID',
  coupon_code             varchar(20),
  promotion_id            varchar(10), 
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_PurchaseDetail        PRIMARY KEY (purchase_id, course_id),
  CONSTRAINT FK_PurchaseToPurDetail   FOREIGN KEY (purchase_id) REFERENCES purchase(id),
  CONSTRAINT FK_CourseToPurDetail       FOREIGN KEY (course_id) REFERENCES courses(id),
  CONSTRAINT FK_CouponToPurDetail       FOREIGN KEY (coupon_code) REFERENCES coupons(code),
  CONSTRAINT FK_PromotionToPurDetail    FOREIGN KEY (promotion_id) REFERENCES promotions(id)
);

CREATE TABLE abusereport (
  course_id               varchar(10)   NOT NULL,
  student_id              varchar(10)   NOT NULL,
  abuse_type              varchar(30)   NOT NULL,
  comment                 varchar(500),
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_AbuseReport             PRIMARY KEY (course_id, student_id),
  CONSTRAINT FK_CourseToAbuseReport     FOREIGN KEY (course_id) REFERENCES courses(id),
  CONSTRAINT FK_UserToAbuseReport       FOREIGN KEY (student_id) REFERENCES users(id)
);

CREATE TABLE questions (
  id                      int           NOT NULL AUTO_INCREMENT,
  title                   varchar(50)   NOT NULL,
  content                 varchar(1000)    NOT NULL,
  course_id               varchar(10)   NOT NULL,
  student_id              varchar(10)   NOT NULL,
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Question                PRIMARY KEY (id),
  CONSTRAINT FK_CourseToQuestion        FOREIGN KEY (course_id) REFERENCES courses(id),
  CONSTRAINT FK_UserToQuestion          FOREIGN KEY (student_id) REFERENCES users(id)
);

CREATE TABLE answers (
  id                      int           NOT NULL AUTO_INCREMENT,
  content                 varchar(1000)    NOT NULL,
  question_id             int           NOT NULL,
  student_id              varchar(10)   NOT NULL,
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Answer                  PRIMARY KEY (id),
  CONSTRAINT FK_QuestionToAnswer        FOREIGN KEY (question_id) REFERENCES questions(id),
  CONSTRAINT FK_UserToAnswer            FOREIGN KEY (student_id) REFERENCES users(id)
);

CREATE TABLE bookmarks (
  student_id              varchar(10)   NOT NULL,
  lecture_id              varchar(10)   NOT NULL,
  note                    varchar(500),
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Bookmark                PRIMARY KEY (student_id, lecture_id),
  CONSTRAINT FK_UserToBookmark          FOREIGN KEY (student_id) REFERENCES users(id),
  CONSTRAINT FK_LectureToBookmark       FOREIGN KEY (lecture_id) REFERENCES lectures(id)
);

CREATE TABLE announcement (
  id                      int           NOT NULL AUTO_INCREMENT,  
  title                   varchar(50)   NOT NULL,
  detail                  varchar(500),
  course_id               varchar(10)   NOT NULL,
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Announcement            PRIMARY KEY (id),
  CONSTRAINT FK_CourseToAnnouncement    FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE advertisements (
  course_id               varchar(10)   NOT NULL,
  title                   varchar(100)  NOT NULL,
  detail                  varchar(500),
  created_at 			        datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Advertisements          PRIMARY KEY (course_id),
  CONSTRAINT FK_CourseToAdvertisements  FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE notifications (
  id                      int           NOT NULL AUTO_INCREMENT,
  type                    varchar(10)   NOT NULL,
  status                  varchar(10)   DEFAULT 'UNREAD',
  message                 varchar(100),
  link                    varchar(100),
  reference_id            varchar(10),
  user_id                 varchar(10)   NOT NULL,
  created_at   			      datetime 		  DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT PK_Notification            PRIMARY KEY (id),
  CONSTRAINT FK_UserToNotification      FOREIGN KEY (user_id) REFERENCES users(id)
);

-- CREATE TABLE Admin (

-- );

-- add status to purchase
-- promotion start date and stop date data type from datetime to date