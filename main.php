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

$library = [
    "Fiction" => [
        "Science Fiction" => ["Dune", "Neuromancer", "Foundation"],
        "Fantasy" => ["The Name of the Wind", "Mistborn", "The Way of Kings"],
        "Mystery" => ["The Girl with the Dragon Tattoo", "Gone Girl", "The Silent Patient"]
    ],
    "Non-Fiction" => [
        "Biography" => ["Steve Jobs", "Becoming", "Educated"],
        "Science" => ["A Brief History of Time", "The Selfish Gene", "Sapiens"],
        "History" => ["The Guns of August", "1776", "The Wright Brothers"]
    ],
    "Children's" => [
        "Picture Books" => ["The Very Hungry Caterpillar", "Where the Wild Things Are", "Goodnight Moon"],
        "Chapter Books" => ["Charlotte's Web", "Harry Potter", "The Lightning Thief"]
    ]
];

$bookInfo = [
    "The Name of the Wind" => ["author" => "Patrick Rothfuss", "year" => 2007, "genre" => "Fantasy"],
    "Mistborn" => ["author" => "Brandon Sanderson", "year" => 2006, "genre" => "Fantasy"],
    "Dune" => ["author" => "Frank Herbert", "year" => 1965, "genre" => "Science Fiction"],
    "Neuromancer" => ["author" => "William Gibson", "year" => 1984, "genre" => "Science Fiction"],
    "The Girl with the Dragon Tattoo" => ["author" => "Stieg Larsson", "year" => 2005, "genre" => "Mystery"],
    "Gone Girl" => ["author" => "Gillian Flynn", "year" => 2012, "genre" => "Mystery"],
    "Steve Jobs" => ["author" => "Walter Isaacson", "year" => 2011, "genre" => "Biography"],
    "Sapiens" => ["author" => "Yuval Noah Harari", "year" => 2011, "genre" => "Science"],
    "The Very Hungry Caterpillar" => ["author" => "Eric Carle", "year" => 1969, "genre" => "Picture Books"],
    "Charlotte's Web" => ["author" => "E.B. White", "year" => 1952, "genre" => "Chapter Books"]
];

function displayLibrary($library, $indent = 0) {
    $spaces = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $indent);
    
    foreach ($library as $category => $contents) {
        if (is_array($contents)) {
            echo $spaces . "📁 <strong>" . $category . "</strong><br>";
            displayLibrary($contents, $indent + 1);
        } else {
            echo $spaces . "📖 <em>" . $contents . "</em><br>";
        }
    }
}

function getBookInfo($title, $bookInfo) {
    if (array_key_exists($title, $bookInfo)) {
        $book = $bookInfo[$title];
        return "
            <div style='background: white; padding: 15px; margin: 10px 0; border-radius: 8px; border-left: 4px solid #3498db;'>
                <h3 style='color: #2c3e50; margin-top: 0;'>📖 $title</h3>
                <p style='margin: 5px 0;'><strong>Author:</strong> {$book['author']}</p>
                <p style='margin: 5px 0;'><strong>Year:</strong> {$book['year']}</p>
                <p style='margin: 5px 0;'><strong>Genre:</strong> {$book['genre']}</p>
            </div>
        ";
    } else {
        return "
            <div style='background: #ffeaa7; padding: 15px; margin: 10px 0; border-radius: 8px; border-left: 4px solid #fdcb6e;'>
                <p style='margin: 0; color: #e17055;'><strong>❌ Book not found:</strong> \"$title\"</p>
            </div>
        ";
    }
}

$bst = new BinarySearchTree();
foreach ($bookInfo as $title => $info) {
    $bst->insert($title);
}

echo "<div style='font-family: Arial, sans-serif; line-height: 1.6; padding: 20px; background-color: #f5f5f5; border-radius: 10px; max-width: 800px; margin: 20px auto;'>";
echo "<h2 style='color: #2c3e50; text-align: center;'>📚 Complete Library System</h2>";

echo "<div style='background: white; padding: 20px; margin: 15px 0; border-radius: 8px;'>";
echo "<h3 style='color: #2c3e50;'>Library Categories (Recursive Display):</h3>";
displayLibrary($library);
echo "</div>";

echo "<div style='background: white; padding: 20px; margin: 15px 0; border-radius: 8px;'>";
echo "<h3 style='color: #2c3e50;'>Books Alphabetically (BST Inorder Traversal):</h3>";
$bst->inorderTraversal($bst->root);
echo "</div>";

echo "<div style='background: white; padding: 20px; margin: 15px 0; border-radius: 8px;'>";
echo "<h3 style='color: #2c3e50;'>Book Details (Hash Table Lookup):</h3>";
echo getBookInfo("The Name of the Wind", $bookInfo);
echo getBookInfo("Dune", $bookInfo);
echo getBookInfo("Charlotte's Web", $bookInfo);
echo "</div>";

echo "<div style='background: white; padding: 20px; margin: 15px 0; border-radius: 8px;'>";
echo "<h3 style='color: #2c3e50;'>BST Search Results:</h3>";
echo "Searching for \"Dune\": " . ($bst->search("Dune") ? "Found!" : "Not Found") . "<br>";
echo "Searching for \"The Hobbit\": " . ($bst->search("The Hobbit") ? "Found!" : "Not Found") . "<br>";
echo "Searching for \"Charlotte's Web\": " . ($bst->search("Charlotte's Web") ? "Found!" : "Not Found");
echo "</div>";

echo "</div>";
?>
