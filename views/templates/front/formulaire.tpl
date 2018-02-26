<h1>{l s='Mon formulaire santé' mod='modulesante'}</h1>
{if isset($success)}
  <p class="success">{$success}</p>
{/if}
<form action="{$link->getModuleLink('modulesante', 'formulaire')|escape:'html'}" method="post">
  <p>
    <label for="date_naissance">Date de naissance*</label><br/>
    <input type="date" id="date_naissance" name="date_naissance" required="required" />
  </p>
  <p>
    <label for="poids">Poids*</label><br/>
    <input type="number" id="poids" name="poids" required="required" />
  </p>
  <p>
    <label>Sexe*</label><br/>
    <input type="radio" name="sexe" value="Homme" id="homme" checked="checked" required="required"/>
    <label for="homme">Homme</label>

    <input type="radio" name="sexe" value="Femme" id="femme"/>
    <label for="femme">Femme</label>
  </p>
  <p>
    <label>Antécédants allergiques*</label><br/>
    <input type="radio" name="allergie" value="1" id="allergie_oui" required="required"/>
    <label for="allergie_oui">Oui</label>

    <input type="radio" name="allergie" value="0" id="allergie_non" checked="checked"/>
    <label for="allergie_non">Non</label>
  </p>
  <p>
    <label>Je suis enceinte*</label><br/>
    <input type="radio" name="enceinte" value="1" id="enceinte_oui" required="required"/>
    <label for="enceinte_oui">Oui</label>

    <input type="radio" name="enceinte" value="0" id="enceinte_non" checked="checked"/>
    <label for="enceinte_non">Non</label>
  </p>
  <p>
    <label>J'allaite*</label><br/>
    <input type="radio" name="allaite" value="1" id="allaite_oui" required="required"/>
    <label for="allaite_oui">Oui</label>

    <input type="radio" name="allaite" value="0" id="allaite_non" checked="checked"/>
    <label for="allaite_non">Non</label>
  </p>
  <p>
    <label for="medicament_actuel">Les médicaments que je prends actuellement*</label><br/>
    <textarea type="number" id="medicament_actuel" col="8" row="10" name="medicament_actuel" required="required"></textarea>
  </p>
  <p>
    <label for="commentaires">Commentaires*</label><br/>
    <textarea type="number" id="commentaires" col="8" row="10" name="commentaires" required="required"></textarea>
  </p>
  <p>
    <input id="submit" name="submit_modulesante" type="submit" value="Submit" class="button" />
  </p>
</form>
