<?php if($isWinner) { ?>
    <div class="modal">
        <img class="modal-cup" src="<?=base_url();?>image/cup.png">
        <div class="modal-title">Congratulations</div>
        <div class="modal-text">You won the lottery.</div>
        <div class="modal-footer">
            <button class="main-button yes-btn modal-btn">Have a beer</button>
        </div>
    </div>

<?php } else { ?>
    <div class="modal">
        <img class="modal-cup" src="<?=base_url();?>image/sorry-cat.png" width="100">
        <div class="modal-title">Sorry</div>
        <div class="modal-text">You didn't win.</div>
        <div class="modal-footer">
            <button class="main-button modal-btn">Don't worry</button>
        </div>
    </div>
<?php } ?>

<script>
    $(document).ready(function () {
        $(".modal").addClass("modal-show");

        $(".modal-btn").click(function () {
            $(".modal").removeClass("modal-show");
        });
    });
</script>