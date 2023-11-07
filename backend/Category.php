<?php

include_once(__DIR__ . '/Database.php');
include_once(__DIR__ . '/UploadFile.php');
// include_once(__DIR__ . '/Product.php');

class Category
{
    private $db;
    private $upload;

    public function __construct()
    {
        $this->db = new Database();
        // $this->upload = new UploadFile();
    }

    public function loadDataOnTable()
    {
        include_once(__DIR__ . '/Product.php');
        $product = new Product();

        $result = $this->db->slectFromCategories();
        // print_r($result);
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['IDdanhmuc'] . "</td>";
            // echo "<td>" . $row['tendanhmuc'] . "</td>";
            echo "<td><a href='Product-category-table.php?id=" . $row['IDdanhmuc'] . "'> " . $row['tendanhmuc'] . "</a></td>";
            echo "<td>" . $product->countProductWithCategory($row['IDdanhmuc']) . "</td>";
            echo "<td><a class='btn btn-warning' href='update_category.php?id=" . $row['IDdanhmuc'] . "'>Edit <i class='fas fa-edit'></i></a></td>";
            echo "<td><a class='btn btn-danger' href='delete_category.php?id=" . $row['IDdanhmuc'] . "'>Delete <i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
        }
    }

    public function getCategoryById($id)
    {
        $result = $this->db->slectFromCategoriesByID($id);
        return $result;
    }

    //get name of category by id
    public function getNameCategoryById($id)
    {
        $result = $this->db->slectFromCategoriesByID($id);
        return $result[0]['tendanhmuc'];
    }

    public function insertCategory($name)
    {
        $result = $this->db->insertCategory($name);
        if ($result) {
            // header('Location: Category-table.php');
            echo "<script>alert('Insert category successfully!')</script>";
            echo "<script>window.location.href='Category-table.php'</script>";

        } else {
            // header('Location: Category-table.php');
            echo "<script>alert('Insert category failed!')</script>";
            echo "<script>window.location.href='Category-table.php'</script>";
        }
    }

    public function getNameById($id)
    {
        $result = $this->db->slectFromCategoriesByID($id);
        return $result[0]['tendanhmuc'];
    }

    public function deleteCategory($id)
    {
        $result = $this->db->deleteCategoryByID($id);
        if ($result) {
            // return true;
            header("Location: " . $_SERVER['HTTP_REFERER']);

        } else {
            // return false;
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    public function updateCategory($id, $name)
    {
        $result = $this->db->updateCategoryByID($id, $name);
        if ($result) {
            echo "<script>alert('Update success');</script>";
            echo ("<script>location.href = 'Category-table.php';</script>");

        } else {
            echo '<script>alert("Update failed");</script>';
            echo ('<script>
                location.reload();
            </script>');

        }
    }

    // Load data to shop page
    public function loadDataToShopPage($start, $limit, $jsget_category, $jsget_sort, $jsget_search)
    {
        $result = $this->db->slectFromCategories();
        foreach ($result as $row) {
            $checked = '';
            if ($jsget_category == $row['IDdanhmuc'])
            {
                $checked = 'checked';
            }
            // $jsget_category = $jsget_category.','. $row['IDdanhmuc'];
            echo ('<div class="mt-2 mb-2 pl-2 form-check">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" '.$checked.' onclick="toPage(' . $start . ', ' . $limit . ', ' . $row['IDdanhmuc'] . ', ' . $jsget_sort . ', ' . $jsget_search . ')" class="form-check-input" id="category-' . $row['IDdanhmuc'] . '">
                <label class="form-check-label" for="category-' . $row['IDdanhmuc'] . '">' . $row['tendanhmuc'] . '</label>
            </div>
        </div>');
        }
    }

}