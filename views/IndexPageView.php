<?php

class IndexPageView {
    private $page;
    private $render;

    function __construct() {
        $this->page = false;
        $this->render = false;
    }

    function displayPage($product_list) {  //fonction principale 1
        $this->template($product_list);
        return $this->render;
    }

    function displayOne($product) { //fonction principale 2
        $this->template($product);
        return $this->render;
    }

    function template($data) { //fonction composition de la page (appelée dans les fonctions principales)
        $this->page = $this->generateHeader();
        if(is_array($data)) {
            $this->page .= $this->templateMultiple($data);
        } else {
            $this->page .= $this->templateSingle($data);
        }
        $this->page .= $this->generateFooter();
        $this->render = $this->generateShell();
    }

    function templateSingle($product) { //si 1 product, appelle le fichier nécessaire
        return $this->generateSingle($product);
    }

    function templateMultiple($product_list) { //si plusieurs products, appelle le fichier nécessaire
        $buffer = $this->generateForm();
        $buffer .=  $this->generateTable($product_list);
        return $buffer;
    }

    // appelle les includes pour fichiers nécessaires
    function generateForm() {
        ob_start();
        include 'views/templates/form.php';
        return ob_get_clean();
    }

    function generateShell() {
        ob_start();
        include 'views/templates/shell.php';
        return ob_get_clean();
    }

    function generateTable($product_list) {
        ob_start();
        include 'views/templates/product_table.php';
        return ob_get_clean();
    }

    function generateSingle($product) {
        ob_start();
        include 'views/templates/product_single.php';
        return ob_get_clean();
    }

    function generateHeader() {
        ob_start();
        include 'views/templates/header.php';
        return ob_get_clean();
    }

    function generateFooter() {
        ob_start();
        include 'views/templates/footer.php';
        return ob_get_clean();
    }

    function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}


/*<?php

class IndexPageView {
    private $page;
    private $render;
    
    function __construct() {
        $this->page = false;
        $this->render = false;
    }
    
    function displayPage($product_list) {
        //notre fonction appellée par le controlleur
        $this->generatePage($product_list);
        return $this->render;
    }
    
    function generateEmptyFormToutNul() {
        ob_start();
            include 'views/templates/form.php';
        return ob_get_clean();
    }
    
    function generateShell() {
        ob_start();
            include 'views/templates/shell.php';
        return ob_get_clean();
    }
    
    function generatePage($product_list) {
        $this->page = $this->generateHeader();
        $this->page .= $this->generateEmptyFormToutNul();
        //j'ajoute la partie à droite à la suite de ce que vaut déjà this->page
        $this->page .= $this->generateTable($product_list);
        $this->page .= $this->generateFooter();
        $this->render = $this->generateShell();
    }
     
    function generateTable($product_list) {
        ob_start();
            include 'views/templates/product_table.php';
        return ob_get_clean();
    }
    
    function generateHeader() {
        ob_start();
            include 'views/templates/header.php';
        return ob_get_clean();
    }
    
    function generateFooter() {
        ob_start();
            include 'views/templates/footer.php';
        return ob_get_clean();
    }
    
    function __get($property) {
        if (property_exists($this, $property)) {
			return $this->$property;
		}
    }
    
    function __set($property, $value) {
        if (property_exists($this, $property)) {
			$this->$property = $value;
		}
    }
}*/