
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

                        $url = isset($_POST['url_short']) ? $_POST['url_short'] : '';
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

                        // Check whether url is existing or not
                        $ch = curl_init();

                        $options = array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_HEADER => true,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_AUTOREFERER => true,
                            CURLOPT_CONNECTTIMEOUT => 120,
                            CURLOPT_TIMEOUT => 120,
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_SSL_VERIFYHOST => false,
                            CURLOPT_SSL_VERIFYPEER => false
                        );
                        curl_setopt_array($ch, $options);
                        $response = curl_exec($ch);
                        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        if ($httpCode != 200) {
                            print_r("<span class = 'text-danger'>Url doesn't exist.</span>");
                            return false;
                        }

                        curl_close($ch);


                        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        //Checking whether  Url alredy existing in db
                        $data_url = "SELECT code  FROM urls where org_url ='" . $url . "'";
                        $result = $conn->query($data_url);
                        if ($result->num_rows <= 0) {
                            // create the charset for the codes and jumble it all up
                            $charset = str_shuffle(CHARSET);
                            $code = substr($charset, 0, URL_LENGTH);

                            $data_code = "SELECT org_url  FROM urls where code =" . $code;
                            // verify the code is not taken
                            while (!empty($conn->query($data_code)))
                                $code = substr($charset, 0, URL_LENGTH);

                            $sql = "INSERT INTO urls (org_url, code) VALUES ('$url', '$code')";

                            if ($conn->query($sql) === false) {

                                die("Error: " . $sql . "<br>" . $conn->error);
                            }
                        } else {
                            $row = $result->fetch_assoc();
                            $code = (!empty($row)) ? $row['code'] : '';
                        }

                        echo "<h3>Orginal url : -<span>" . $url . "</span></h3>";

                        echo '<br><h3>Short url :- <span>' . URL_Prefix . $code . "</span></h3>";
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
