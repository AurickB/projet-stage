<?php 

class Text {
    /**
     * Création d'une classe qui possède une méthode "Text" .
     * Cette méthode prend en premier paramètre le contenu que je souhaite afficher et un deuxième paramètre le nombre de caractère maximun.
     */
    public static function excerpt(string $content, int $limit = 200)
    {
        // On vérifie si la chaine de caractère est inférieur ou égale à la limite.
        if (mb_strlen($content) <= $limit){
            return $content;
        }
        // Récupérer le premier espace à partir de la limite.
        $lastSpace = mb_strpos($content, ' ', $limit);
        // On coupe au dernier espace
        return mb_substr ($content, 0 ,$lastSpace) . ' ...';
    }
}
?>