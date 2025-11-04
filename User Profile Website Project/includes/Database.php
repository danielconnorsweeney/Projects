<?php
    // config file
    require_once 'config.php';
    class Database{
        // private property for PDO connection object
        private $pdo;
        // public property for storing errors
        public $error = null;

        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        private function validateImage(array $fileData){
            // check for if image actually got uploaded
            if(empty($fileData['name'])){
                $this->error = 'Please select an image';
                return false;
            }

            // get file properties
            $fileName = $fileData['name'];
            $fileTmpName = $fileData['tmp_name'];
            $fileSize = $fileData['size'];
            $fileError = $fileData['error'];
            // Check for upload errors
            if($fileError !== 0){
                $this->error = 'There was an error uploading your image file.';
                return false;
            }

            // define allowed image file types
            $allowed = ['jpg', 'jpeg', 'gif', 'png'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if(!in_array($fileExt, $allowed)){
                $this->error = "Invalid image file, must be jpg, jpeg, gif or png.";
                return false;
            }

            // set a max file size
            $maxSize = 2 * 1024 * 1024; // equal to 2mb
            if($fileSize > $maxSize){
                $this->error = 'File size must be less than 2 MB';
                return false;
            }

            // Create unique file name to prevent overwriting and path traversal attacks
            $newFileName = uniqid('', true) . '.' . $fileExt;
            $fileDestination = 'uploads/' . $newFileName;

            // move the uploaded file from the temporary location to final folder
            if(!move_uploaded_file($fileTmpName, $fileDestination)){
                $this->error = 'File upload failed';
                return false;
            }
            // if the upload checks all the passes, return the path to be stored in SQL database
            return $fileDestination;
        }
        /**
         * Create function (INSERT)
         */
        /**
         * Inserts a new profile record, including username, profile image, and validation
         * @param string $userName - users profile name
         * @param array $fileData - the $_FILES array for users profile image
         * @return bool True on success, false on failure
         */

        // create function for username and profile image
        public function create($userName, array $fileData){
            // validate and upload image
            $imagePath = $this->validateImage($fileData);
            // if validation fails, stop and return false
            if ($imagePath == false){
                return false;
            }
            try{
                // prepare SQL insert statement using PDO prepared statements for security
                $sql = "INSERT INTO profiles (user_name, image_path) VALUES (:user_name, :image_path)";

                // prepare our statement
                $stmt = $this->pdo->prepare($sql);

                // bind our values to placeholders to prevent SQL injection
                $stmt->bindParam(':user_name', $userName);
                $stmt->bindParam(':image_path', $imagePath);

                // fire the statement
                return $stmt->execute();
            }catch (PDOException $e){
                // store  error message
                $this->error = "Database error: " . $e->getMessage();
                // if database insert fails, nuke the uploaded image
                if (file_exists($imagePath)){
                    unlink($imagePath);
                }
                return false;
            }
        }

        public function read(){
            try {
                // store  sql select statement
                $sql = "SELECT * FROM profiles ORDER BY id DESC";

                //execute query
                $stmt = $this->pdo->query($sql);

                // fetch  results in associative array
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                $this->error = "Database read error: " . $e->getMessage();
                return false;
            }
        }

    }
    // global variable to hold database object
    $db = new Database($pdo);
    ?>