const form = `
            <div class="flex items-center" >
                <form action="./actions/insert.php" method="post" class="flex flex-wrap items-center gap-10 p-3">
                <div>
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" class="" required>
                </div>
                <div>
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" required>
                </div>
                <div>
                    <label for="date_naissance">Date de naissance :</label>
                    <input type="date" name="date_naissance" id="date_naissance" required>
                </div>
                <div>
                    <label for="adresse">Adresse :</label>
                    <input type="text" name="adresse" id="adresse" required>
                    </div>
                <div>
                    <label for="parcours">Parcours :</label>
                    <select name="parcours" id="parcours" required>
                        <option value="Informatique">Informatique</option>
                        <option value="Mathematiques">Mathematiques</option>
                        <option value="Physique">Physique</option>
                        <option value="Chimie">Chimie</option>
                        <option value="Biologie">Biologie</option>
                        <option value="Geologie">Geologie</option>
                        <option value="Geographie">Geographie</option>
                        <option value="Histoire">Histoire</option>
                    </select>
                </div>
                <div>
                    <label for="sexe">Sexe :</label>
                        <span class="cursor-default ">Masculin</span>
                        <input type="radio" name="sexe" id="sexe_m" value="M" required>
                        <span class="cursor-default ">Féminin</span>
                        <input type="radio" name="sexe" id="sexe_f" value="F" required>
                </div>
                <input type="submit" value="Ajouter" class="p-2 text-white bg-emerald-600 hover:bg-emerald-700 h-10 w-20">
                </form>
                <button class="p-2 text-white bg-emerald-600 hover:bg-emerald-700 h-10 w-20" onclick="cancel()">Cancel</button>
            </div>
        `;

const part = document.getElementById("form");

const add = () => {
  part.innerHTML = form;
};

const cancel = () => {
  part.innerHTML =
    '<button onclick="add()" class="p-2 text-white bg-emerald-600 hover:bg-emerald-700 h-10 w-20" >Add</button>';
};
