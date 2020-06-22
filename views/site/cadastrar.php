<div class="site-cadastro row">
    <div class="form-group col-md-12">
        <label for="nome">Nome: <span id="required-nome" class="text-danger">*</span></label>
        <input class="form-control" type="text" id="nome" name="Pessoas[nome]">
    </div>
    <div class="form-group col-md-6">
        <label for="celular">Celular: <span id="required-celular" class="text-info">?</span></label>
        <input class="form-control" type="text" minlength="14" maxlength="15" id="celular" name="Pessoas[celular]" onkeypress="mascara(this, celular_mask)">
    </div>
    <div class="form-group col-md-6">
        <label for="email">E-mail:  <span id="required-email" class="text-info">?</span></label>
        <input class="form-control" type="email" id="email" name="Pessoas[email]">
    </div>
    <div class="form-group col-md-6">
        <label for="cpf">Cpf:  <span id="required-cpf" class="text-danger">*</span></label>
        <input class="form-control" type="text" minlength="14" maxlength="14" id="cpf" name="Pessoas[cpf]" onkeypress="mascara(this, cpf_mask)">
    </div>
    <div class="form-group col-md-6">
        <label for="data_nascimento">Data de nascimento:</label>
        <input class="form-control" type="date" id="data_nascimento" name="Pessoas[data_nascimento]">
    </div>
    <div class="col-md-12">
        <?php foreach($categorias as $categoria) { ?>
            <div class="checkbox">
                <label for="categoria-<?= $categoria->codigo ?>">
                    <input
                        class="check"
                        type="checkbox"
                        name="Pessoas[codigo_categoria]"
                        id="categoria-<?= $categoria->codigo ?>"
                        value="<?= $categoria->codigo ?>">
                    
                        <?= $categoria->descricao ?>
                </label>
            </div>
        <?php } ?>
        <div id="categorias-alert" class="hidden alert alert-danger" role="alert">
            <p class="text-danger">Selecione pelo menos uma categoria.</p>
        </div>
    </div>
    <div class="col-md-12 form-group">
        <button class="btn btn-primary" id="btn-send" type="button" onclick="submit()">Cadastrar!</button>
    </div>
    <div class="col-md-12">
        <div id="feedback-final" class="hidden alert alert-success" role="alert">
            <p class="text-success">Usuário cadastrado com sucesso.</p>
        </div>
    </div>
</div>
<script>
    
function submit() {
    $("#btn-send").prop("disabled", true);
    $("#feedback-final").addClass("hidden");
    var requireNome = requireField("nome");
    var requireCpf = requireField("cpf") && verifyMinLength("cpf", 14);
    var requireCpfOrPhone = verifyEmailOrPhone();
    var requireCategories = verifyCategories();
    if(requireNome && requireCpf && requireCpfOrPhone && requireCategories) {
        ajaxSubmission();
        return true;
    } else {
        $("#btn-send").prop("disabled", false);
        return false;
    }
}

function requireField(fieldName) {
    var field = $("#" + fieldName).val();
    var fieldcontainer = $("#" + fieldName).parent();    
    if(!field.trim().length) {
        fieldcontainer.addClass("has-error");
        fieldcontainer.find("label").addClass("text-danger");
        return false;
    } else {
        fieldcontainer.removeClass("has-error");
        fieldcontainer.find("label").removeClass("text-danger");
        return true;
    }
}

function verifyMinLength(fieldName, minValue) {
    var field = $("#" + fieldName).val();
    var fieldcontainer = $("#" + fieldName).parent(); 
    var hasMinValue = field.length >= minValue;
    if(!hasMinValue) {
        fieldcontainer.addClass("has-error");
        fieldcontainer.find("label").addClass("text-danger");
        return false;
    } else {
        fieldcontainer.removeClass("has-error");
        fieldcontainer.find("label").removeClass("text-danger");
        return true;
    }
}

function verifyEmailOrPhone() {
    var email = $("#email").val();
    var celular = $("#celular").val();

    if(!email.trim().length && !celular.trim().length) {
        requireField("email");
        requireField("celular");
        return false;
    } else {
        if(email.trim().length && verifyValidEmail(email)) {
            validEmailOrPhone();
            return true;
        } else if(celular.trim().length && verifyValidPhone(celular)) {
            validEmailOrPhone();
            return true;
        } else {
            validEmailOrPhone(false);
            return false;
        }

    }
}

function validEmailOrPhone(isValid = true) {
    var emailContainer = $("#email").parent();
    var phoneContainer = $("#celular").parent();
    if (isValid) {
        emailContainer.removeClass("has-error");
        emailContainer.find("label").removeClass("text-danger");
        phoneContainer.removeClass("has-error");
        phoneContainer.find("label").removeClass("text-danger");
    } else {
        emailContainer.addClass("has-error");
        emailContainer.find("label").addClass("text-danger");
        phoneContainer.addClass("has-error");
        phoneContainer.find("label").addClass("text-danger");
    }
}

function verifyValidEmail(email) {
    return email.match(/(\d|\w)@((\d|\w)\.(\d|\w))+/gi);
}

function verifyValidPhone(phone) {
    return phone.length >= 14 && phone.length <= 15;
}

function verifyCategories() {
    var categorias = $('[name="Pessoas[codigo_categoria]"]:checked');
    if (categorias.length) {
        $("#categorias-alert").addClass("hidden");
        return true;
    } else {
        $("#categorias-alert").removeClass("hidden");
        return false;
    }
}

function resetFields() {
    ['nome','email', 'cpf', 'celular', 'data_nascimento'].forEach(function(fieldName) {
        $("#" + fieldName).val("");
    });

    $('.check').each(function(){
        $(this).prop("checked", false);
    })
}

function ajaxSubmission() {
    var nome = $("#nome").val();
    var email = $("#email").val();
    var cpf = $("#cpf").val();
    var celular = $("#celular").val();
    var data_nascimento = $("#data_nascimento").val();
    var categorias = [];
    $('.check:checked').each(function(){
        categorias.push($(this).val());
    });
    var data = {nome, email, cpf, celular, categorias, data_nascimento};
    $.post("/site/cadastrar", {data}, function(result){
        $("#btn-send").prop("disabled", false);
        $("#feedback-final").removeClass("hidden");
        resetFields();
    })
}
</script>

<script>
// mascaras
function mascara(ojeto,funcao){
    v_obj=ojeto
    v_fun=funcao
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function celular_mask(valor){
    valor=valor.replace(/\D/g,"")                 //Remove tudo o que não é dígito
    valor=valor.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
    valor=valor.replace(/(\d{5})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
    return valor
}
function cpf_mask(valor){
    valor=valor.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    valor=valor.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    valor=valor.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    valor=valor.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return valor
}
</script>