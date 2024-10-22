<?php
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertNewTutorBtn'])) {
    $query = insertTutor($pdo, $_POST['firstName'], $_POST['lastName'], $_POST['gender'], 
                        $_POST['age'], $_POST['subjectSpecialization']);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Insertion Failed";
    }
}

if (isset($_POST['editTutorBtn'])) {
    $tutor_id = $_GET['tutor_id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $subject_specialization = $_POST['subjectSpecialization'];

    $query = updateTutor($pdo, $firstName, $lastName, $gender, $age, $subject_specialization, $tutor_id);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Edit Failed";
    }
}


if(isset($_POST['deleteTutorBtn'])) {
    $query = deleteTutor($pdo, $_GET['tutor_id']);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Deletion Failed";
    }
}

if(isset($_POST['addPupilBtn'])) {
    $tutor_id = $_GET['tutor_id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];

    $query = insertPupil($pdo, $firstName, $lastName, $gender, $age, $tutor_id);

    if ($query) {
        header("Location: ../pupil/newPupil.php?tutor_id=" . $_GET['tutor_id']);
    } else {
        echo "Insertion Failed";
    }
}

if (isset($_POST['editPupilBtn'])) {
    $pupil_id = $_GET['pupil_id'];
    $firstName = $_POST['firstName'];  // should use the value of name attribute in input :)))
    $lastName = $_POST['lastName'];   
    $gender = $_POST['gender'];        
    $age = $_POST['age'];              

    $query = updatePupil($pdo, $firstName, $lastName, $gender, $age, $pupil_id);

    if ($query) {
        header("Location: ../pupil/newPupil.php?tutor_id=" . $_GET['tutor_id']);
        exit; 
    } else {
        echo "Update Failed";
    }
}

if (isset($_POST['deletePupilBtn'])) {
    $query = deletePupil($pdo, $_GET['pupil_id']);

    if ($query) {
        header("Location: ../pupil/newPupil.php?tutor_id=" . $_GET['tutor_id']);
    }
}
?>