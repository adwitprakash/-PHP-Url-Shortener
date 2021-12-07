
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>URL Shortener</title>
        <style>
            h3{
                color:#851a31;
                font-weight:bold;
                font-size:18px
            }  
            h3 span{
                color:#981e38;
                font-weight:bold;
                font-size:16px;
                display: block

            }
            .box{
                background: #d6d4d4;
                padding: 25px;
                border-radius: 9px;

                box-shadow: 5px 4px 70px rgba(0,0,0,0.30);
            }
        </style>
    </head>
    <body>
        <div class="container pt-5">
            <div class="row d-flex justify-content-center">
                <div  class="col-md-8 box ">
                    <?php
                    try {
                        require_once 'config.php';

                        $url = isset($_POST['url_redirect']) ? $_POST['url_redirect'] : '';
                        $parm = parse_url($url);
                        parse_str($parm['query'], $query);
                        $prefix = parse_url(URL_Prefix);
                        $code = isset($query['code']) ? $query['code'] : '';
                        // Checking whether url is supplied or not
                        if (empty($url)) {
                            print_r("<span class = 'text-danger'>No url was supplied.</span>");
                            return false;
                        }
                        // Validating the url
                        if (!filter_var($url, FILTER_VALIDATE_URL)) {
                            print_r("<span class = 'text-danger'>Its not valid url");
                            return false;
                        }
                        // Checking whether code is supplied or not
                        if (empty($code)) {
                            print_r("<span class = 'text-danger'>Code not supplied .</span>");
                            return false;
                        }
                        // Checking whether host is same as we supplied
                        if ($parm['host'] != $prefix['host']) {
                            print_r("<span class = 'text-danger'>Host is different .</span>");
                            return false;
                        }



                        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        //Checking whether  code  existing in db
                        $data_url = "SELECT org_url  FROM urls where code ='" . $code . "'";
                        $result = $conn->query($data_url);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $org_url = (!empty($row)) ? $row['org_url'] : '';
                            //Redirecting to orginal url
                            header("Location: " . $org_url);
                        } else {
                            print_r("<span class = 'text-danger'>Code does not  exist .</span>");
                            return false;
                        }
                    } catch (Exception $e) {
                        // Display error
                        echo $e->getMessage();
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




    </body>
</html>
