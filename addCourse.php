<?php
    require "header.php";
    if ($_SESSION['userType'] != "admin") {
        header("Location: javascript:history.go(-1)");
        die();
    }
?>

    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <label class="addCourse-label">Add Course</label>
            <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "emptyfields") {
                        echo "<label class='addCourse-error'>Fill in all Fields !</label>";
                    }
                    else if ($_GET['error'] == "invalid") {
                        echo "<label class='addCourse-error'>Invalid Format</label>";
                    }
                    else if ($_GET['error'] == "invaildID") {
                        echo "<label class='addCourse-error'>Invalid ID</label>";
                    }
                    else if ($_GET['error'] == "invaildName") {
                        echo "<label class='addCourse-error'>Invalid Name</label>";
                    }
                    else if ($_GET['error'] == "invaildYear") {
                        echo "<label class='addCourse-error'>Invalid Year</label>";
                    }
                    else if ($_GET['error'] == "invaildMonth") {
                        echo "<label class='addCourse-error'>Invalid Month</label>";
                    }
                    else if ($_GET['error'] == "taken") {
                        echo "<label class='addCourse-error'>Course Has Already Been Taken</label>";
                    }
                    else if ($_GET['error'] == "mysqlerror") {
                        echo "<label class='addCourse-error'>Error</label>";
                    }
                }
                else if (isset($_GET['addCourse'])) {
                    if ($_GET['addCourse'] == "success") {
                        echo "<label class='addCourse-success'>Add Course Success</label>";
                    }
                }
            ?>
            <div class="addCourse-main">
                <form action="backendphp/addCourse-back.php" method="post">
                    <label>Course ID</label>
                    <input type="text" name="add_course_id" maxlength="4"><br>
                    <label>Course Name</label>
                    <input type="text" name="add_course_name"><br>
                    <label>Year</label>
                    <select name="add_course_year" id="">
                    <?php 
                        for($i = 2000 ; $i < 2099; $i++){
                            echo "<option>" . $i . "</option>";
                        }
                    ?>
                    </select><br>
                    <label>Month</label>
                    <select name="add_course_month">
                        <option name="-SELECT-MONTH-">-SELECT-MONTH-</option>
                        <option name="January" value="January">January</option>
                        <option name="February" value="February">February</option>
                        <option name="March" value="March">March</option>
                        <option name="April" value="April">April</option>
                        <option name="May"value="May">May</option>
                        <option name="June" value="June">June</option>
                        <option name="July" value="July">July</option>
                        <option name="August" value="August">August</option>
                        <option name="September" value="September">September</option>
                        <option name="October" value="October">October</option>
                        <option name="November" value="November">November</option>
                        <option name="December" value="December">December</option>
                    </select>
                    <br>
                    <div class="btn">
                        <button type="submit" name="add_course_submit">Add</button><br>
                        <a class="cxlAddCourse-btn" href="javascript:history.go(-1)"><span>Cancel</span></a>
                    </div>
                </form>
                
            </div>
        </div>
    </main>

<?php
    require "footer.php";
?>