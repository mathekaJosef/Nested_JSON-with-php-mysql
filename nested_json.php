<?php
    //Create Database connection
    require_once('connect.php');


    $query = mysqli_query($connect, "SELECT * FROM quizzes"); 
    $json_response = array(); //Create an array
    while ($row = mysqli_fetch_array($query))
    {
        $row_array = array();
        $row_array['lesson_id'] = $row['lesson_id'];
        $row_array['id'] = $row['id'];
        $row_array['quiz'] = $row['name'];
        $row_array['choices'] = array();
        $row_array['created_at'] = $row['created_at'];
        $row_array['updated_at'] = $row['updated']; 
        $quiz_id = $row['id'];

        $choice_query = mysqli_query($connect, "SELECT * FROM choices where quiz_id=$quiz_id");
        while ($row1 = mysqli_fetch_array($choice_query))
        {
            $row_array['choices'][] = array(
                'quiz_id' => $row1['quiz_id'],
                'id' => $row1['id'],
                'choice' => $row1['name'],
                'created_at' => $row1['created_at'],
                'updated_at' => $row1['updated_at'],
                
            );


        }
        array_push($json_response, $row_array); //push the values in the array


        

    }
    echo json_encode($json_response,JSON_PRETTY_PRINT);
?>  