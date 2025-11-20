<?php
class Node {
    public $data;
    public $left;
    public $right;
    public function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}

class BinarySearchTree {
    public $root;
    
    public function __construct() {
        $this->root = null;
    }
    
    public function insert($data) {
        $newNode = new Node($data);
        
        if ($this->root === null) {
            $this->root = $newNode;
            return;
        }
        
        $current = $this->root;
        while (true) {
            if (strcasecmp($data, $current->data) < 0) {
                if ($current->left === null) {
                    $current->left = $newNode;
                    return;
                }
                $current = $current->left;
            } else {
                if ($current->right === null) {
                    $current->right = $newNode;
                    return;
                }
                $current = $current->right;
            }
        }
    }
    
    public function search($data) {
        $current = $this->root;
        
        while ($current !== null) {
            $compare = strcasecmp($data, $current->data);
            
            if ($compare === 0) {
                return true;
            } elseif ($compare < 0) {
                $current = $current->left;
            } else {
                $current = $current->right;
            }
        }
        
        return false;
    }
    
    public function inorderTraversal($node) {
        if ($node !== null) {
            $this->inorderTraversal($node->left);
            echo $node->data . "<br>";
            $this->inorderTraversal($node->right);
        }
    }
}

// Create BST and insert books
$bst = new BinarySearchTree();
$bst->insert("The Name of the Wind");
$bst->insert("Dune");
$bst->insert("Charlotte's Web");
$bst->insert("Gone Girl");
$bst->insert("Sapiens");
$bst->insert("The Very Hungry Caterpillar");
$bst->insert("Neuromancer");

// Display results
echo "<div style='font-family: Arial, sans-serif; padding: 20px;'>";
echo "<h3>Inorder Traversal (Alphabetical):</h3>";
echo "<div style='background: white; padding: 15px; border-radius: 8px;'>";
$bst->inorderTraversal($bst->root);
echo "</div>";

echo "<h3>Search Results:</h3>";
echo "<div style='background: white; padding: 15px; border-radius: 8px;'>";
echo "Searching for \"Dune\": " . ($bst->search("Dune") ? "Found!" : "Not Found") . "<br>";
echo "Searching for \"The Hobbit\": " . ($bst->search("The Hobbit") ? "Found!" : "Not Found") . "<br>";
echo "Searching for \"Charlotte's Web\": " . ($bst->search("Charlotte's Web") ? "Found!" : "Not Found") . "<br>";
echo "Searching for \"Inferno\": " . ($bst->search("Inferno") ? "Found!" : "Not Found");
echo "</div>";
echo "</div>";
?>

// can you make it diffirent code but same output?
