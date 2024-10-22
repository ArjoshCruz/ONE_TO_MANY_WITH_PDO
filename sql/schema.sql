CREATE TABLE tutor_record (
    tutor_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    gender VARCHAR(50),
    age INT,
    subject_specialization VARCHAR(50),
    date_added timestamp default current_timestamp
);

CREATE TABLE pupil_record (
    pupil_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    gender VARCHAR(50),
    age INT,
    tutor_id INT,
    date_added timestamp default current_timestamp
)