<?php
use App\Annonce\Annonce;
use App\HTML\Form;
use App\Image\Image;
use App\Session\Session;
use App\Core\Table;

$form = new Form($_POST);

Table::setTitle('Ajouter une annonce');

if(isset($_POST['add'])) {

    $date = date('Y-m-d');
    $titre = $_POST['titre'];
    $name = $_POST['autor'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['price'];
    $online = 1;
    $message = $_POST['content'];
    $file = $_FILES['image'];
    if($file['size'] >= 1 && $file['size'] <= 4096000) :
        $nom = time().'.jpg';
        Image::Create($file, $nom);
        Annonce::Create([
            'titre'     => $titre,
            'content'   => $message,
            'autor'     => $name,
            'quantite'  => $quantite,
            'price'     => $prix,
            'image'     => $nom,
            'date'      => $date,
            'online'    => $online
        ]);
        Session::setFlash("L'annonce à bien été ajoutée.", 'success');
        Table::Redirect('annonces');
    else :
        $_SESSION['error'] = "INFORMATION : Image refusée - taille trop importante | Maxi. 500 Ko";
    endif;
}
?>

<div class="header">
    <h1>Ajouter une annonce</h1>
</div>
<?php if(!empty($_SESSION['error'])) : ?>
    <div id="alert" class="alert">
        <span class="icon-error"></span><!--
    --><span class="text-error"><?php echo $_SESSION['error'];?></span>
    </div>
<?php endif;
unset($_SESSION['error']); ?>
<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('titre', "Titre de l'annonce :");?>

        <?= $form->input('autor', 'Auteur :', 'Format : Prénom + Nom de famille');?>

        <?= $form->textarea('content');?>

        <?= $form->input('quantite', 'Quantité :');?>

        <?= $form->input('price', 'Prix :');?>

        <?= $form->file('image', "Image d'illustration", 'Formats JPG/PNG | Maxi. 500 Ko', 4096000)?>

        <?= $form->submit('add', 'Ajouter', 'annonces') ;?>
    </form>
</div>