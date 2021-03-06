<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Privatchat</div>
                <div class="card-body centered">
                    <form action="/home/chat" method="get">
                        @if(\Illuminate\Support\Facades\Auth::user()["lehrer"] === 1)
                            <input type="text" class="form-control-plaintext" name="name" placeholder="Schülername eingeben..."
                                   id="chatAutocomplete">
                            <input type="hidden" value="0" name="lehrer">
                        @else
                            <input type="text" class="form-control-plaintext" name="name" placeholder="Lehrername eingeben..."
                                   id="chatAutocomplete">
                            <input type="hidden" value="1" name="lehrer">
                        @endif
                        <br />
                        <button class="btn btn-primary">Suchen <i class="fa fa-fw fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    <?php
        if(\Illuminate\Support\Facades\Auth::user()["lehrer"] === 1) {
            $alleSchueler = \App\User::where("lehrer", 0)->get();
            $suggestions = [];

            foreach ($alleSchueler as $schueler) {
                array_push($suggestions, $schueler->name);
            }
        } else {
            $alleLehrer = \App\User::where("lehrer", 1)->get();
            $suggestions = [];

            foreach ($alleLehrer as $lehrer) {
                array_push($suggestions, $lehrer->name);
            }
        }
    ?>

    let chatSuggestions = JSON.parse('<?= json_encode($suggestions) ?>');
  
    window.addEventListener('DOMContentLoaded', () => {
      $(function () {
         $("#chatAutocomplete").autocomplete({
             source: chatSuggestions
         });
      });
    });
</script>