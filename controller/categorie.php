<?php
    $req = select("photo as p",
                "p.id, p.name, p.title, p.text, p.extention, p.user_id, u.login, GROUP_CONCAT(r.id) AS rubid, GROUP_CONCAT(r.title) AS rubric_title",
                "INNER JOIN user as u ON p.user_id = u.id
                INNER JOIN rubric_has_photo AS rp ON rp.photo_id=p.id
                INNER JOIN rubric AS r ON r.id = rp.rubric_id
                WHERE r.url = '".$_GET['menu']."'
                GROUP BY p.id
                ORDER BY p.id DESC
                ");
    $nombre_images = !is_string($req)? mysqli_num_rows($req):0;
    
    $limit_a=isset($_GET['pg'])?($_GET['pg']-1)*$nombre_images_page:0;
    $limit_b=$nombre_images_page;
    $images_affiche= select("photo as p",
                                    "p.id, p.name, p.title, p.text, p.extention, p.user_id, u.login, GROUP_CONCAT(r.id) AS rubid, GROUP_CONCAT(r.title) AS rubric_title",
                                    "INNER JOIN user as u ON p.user_id = u.id
                                    INNER JOIN rubric_has_photo AS rp ON rp.photo_id=p.id
                                    INNER JOIN rubric AS r ON r.id = rp.rubric_id
                                    WHERE r.url = '".$_GET['menu']."'
                                    GROUP BY p.id
                                    ORDER BY p.id DESC
                                    LIMIT ".$limit_a.",".$limit_b."
                                    "); 
    include_once 'view/categorie.php';
