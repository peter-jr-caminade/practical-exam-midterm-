<?php
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

echo "<div style='font-family: Arial, sans-serif; line-height: 1.6; padding: 20px; background-color: #f5f5f5; border-radius: 10px; max-width: 600px; margin: 20px auto;'>";
echo "<h2 style='color: #2c3e50; text-align: center;'>📚 Book Information Lookup</h2>";

echo getBookInfo("The Name of the Wind", $bookInfo);
echo getBookInfo("Dune", $bookInfo);
echo getBookInfo("Charlotte's Web", $bookInfo);

echo "</div>";
?>
