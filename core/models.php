<?php
// TUTOR
function insertTutor ($pdo, $firstName, $lastName, $gender, $age, $subjectSpecialization) {
        $sql = "INSERT INTO tutor_record (first_name, last_name, gender, age, subject_specialization)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$firstName, $lastName, $gender, $age, $subjectSpecialization]);

        if ($executeQuery) {
            return true;
    }
}

function getAllTutors ($pdo) {
    $sql = "SELECT * FROM tutor_record";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getTutorByID ($pdo, $tutor_id) {
    $sql = "SELECT * FROM tutor_record
            WHERE tutor_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$tutor_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

function updateTutor($pdo, $first_name, $last_name, $gender, $age, $subjectSpecialization, $tutorID) {
    $sql = "UPDATE tutor_record
                SET first_name = ?,
                    last_name = ?,
                    gender = ?,
                    age = ?,
                    subject_specialization = ?
                WHERE tutor_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $isUpdated = $stmt->execute([$first_name, $last_name, $gender, $age, $subjectSpecialization, $tutorID]);

    if ($isUpdated) {
        return true;
    } else {
        return false;
    }
}


function deleteTutor($pdo, $tutor_id){
    $sql = "DELETE FROM tutor_record
            WHERE tutor_id = ?";
    $stmt = $pdo->prepare($sql);

    $executeQuery = $stmt->execute([$tutor_id]);

    if ($executeQuery){
        return true;
    }
}

// PUPIL
function getPupilsByTutor($pdo, $tutor_id) {
    $sql = "SELECT
                pupil_record.pupil_id AS pupil_id,
                pupil_record.first_name AS pupil_first_name,
                pupil_record.last_name AS pupil_last_name,
                pupil_record.gender AS pupil_gender,
                pupil_record.age AS pupil_age,
                pupil_record.date_added AS pupil_date_added
            FROM pupil_record
            JOIN tutor_record ON 
                pupil_record.tutor_id = tutor_record.tutor_id
            WHERE pupil_record.tutor_id = ?
            GROUP BY pupil_id;
        ";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$tutor_id]);
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function insertPupil ($pdo, $first_name, $last_name, $gender, $age, $tutor_id) {
    $sql = "INSERT INTO pupil_record (first_name, last_name, gender, age, tutor_id) VALUES (?, ?, ?, ?, ?)
            ORDER BY pupil_id";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $gender, $age, $tutor_id]);
    if ($executeQuery) {
        return true;
    }
}

function getPupilById($pdo, $pupil_id) {
    $sql = "SELECT
                pupil_record.pupil_id AS pupil_id,
                pupil_record.first_name AS pupil_first_name,
                pupil_record.last_name AS pupil_last_name,
                pupil_record.gender AS pupil_gender,
                pupil_record.age AS pupil_age,
                pupil_record.date_added AS pupil_date_added
            FROM pupil_record
            JOIN tutor_record ON 
                pupil_record.tutor_id = tutor_record.tutor_id
            WHERE pupil_record.pupil_id = ?
            GROUP BY pupil_first_name;
            ";

    $stmt = $pdo->prepare($sql);
    $executeQuery= $stmt->execute([$pupil_id]);
    if ($executeQuery) {
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    } else {
        echo "Error executing query";
        return null;
    }
}

function updatePupil($pdo, $first_name, $last_name, $gender, $age, $pupil_id) {
    $sql = "UPDATE pupil_record
            SET first_name = ?,
                last_name = ?,
                gender = ?,
                age = ?
            WHERE pupil_id = ?
            ORDER BY pupil_id";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $gender, $age, $pupil_id]);

    if ($executeQuery) {
        return true;
    }
}

function deletePupil($pdo, $pupil_id){
    $sql = "DELETE FROM pupil_record WHERE pupil_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$pupil_id]);
    if ($executeQuery){
        return true;
    }
}
?>