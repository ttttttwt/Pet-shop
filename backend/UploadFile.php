<?php

class UpLoadFile
{
    private $file_name;
    private $file_size;
    private $file_type;
    private $file_extension;
    private $destination;
    private $premitted_extension = array('jpg', 'png', 'jpeg', 'gif');
    private $generated_filename;
    private $max_size = 10000000;



    public function __construct($file, $destination)
    {
        // print_r($file);
        $this->file_name = $file['tmp_name'];
        $this->file_size = $file['size'];
        $this->file_type = $file['type'];
        $this->generated_filename = uniqid() . '-' . $file['name'];
        $this->destination = $destination . $this->generated_filename;
        $this->file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    }

    
    public function upload()
    {
        try {
            if ($this->file_size > $this->max_size) {
                throw new Exception('File size is too large');
            }
            if (!in_array($this->file_extension, $this->premitted_extension)) {
                throw new Exception('File type is not allowed');
            }
            if (!move_uploaded_file($this->file_name, $this->destination)) {
                throw new Exception('File cannot be uploaded');
            }

            return true;
        } catch (Exception $e) {
            // echo $e->getMessage();
            return false;
        }
    }

    public function getFileName()
    {
        return $this->destination;
    }

    public function imformation()
    {
        echo "File name: " . $this->file_name . "<br>";
        echo "File size: " . $this->file_size . "<br>";
        echo "File type: " . $this->file_type . "<br>";
        echo "File extension: " . $this->file_extension . "<br>";
        echo "Destination: " . $this->destination . "<br>";
    }
}

// echo 'Hello World'.uniqid();