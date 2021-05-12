## Psuedokod för BlogHelp

Detta är psuedokoden för bloghelp klassen. Klassen ska är en sorts hjälp när man ska lägga till data i databasen och hjälpa till att rendera vyer. 

<pre>
Class BlogHelp:
    # en konstant där namn på vyer ligger
    CONST VIEWS ['view1', 'view2', 'view3] 

    # En funktion som kollar om bild 2 är ifylld medans bild 1 inte är ifylld på formuläret

    function checkImage(image1, image2):
        if image1 == null and image2 != null:
            image1 = image2
            image2 = null
        return [image1, image2];

    # En funktion som kollar hur många bilder som finns och returnerar rätt vy

    function hasImage(image1, image2):
        count = 0
        if image1 != null:
            count++
            if image2 != null:
                count++
        return VIEWS[count]

    # En funktion som kollar om publiseringen är synlig

    function isPublished($blog->published):
        if $blog->published <= now():
            return True
        return False
</pre>