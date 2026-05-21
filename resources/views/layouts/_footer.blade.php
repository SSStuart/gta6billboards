<footer>
    @ssstuart
    <hr style="width: min(80%, 20ch);color:#8884; border-style: solid;">
    <button class="tooltipTarget" id="iaDisclaimerBtn">
        <i class='iiicon' data-name='ai_info'></i>
        <span class="tooltip">AI usage disclaimer</span>
    </button>

    <dialog class="app-dialog" id="aiDisclaimer" closedby="any">
        <form method="dialog">
            <button autofocus class="dialogCloseBtn"><i class='iiicon' data-name='close' title='Close'>X</i></button>
        </form>
        <h2><i class='iiicon' data-name='info'></i> <span>AI usage disclaimer</span></h2>
        <p id="aiDisclaimerGeneral">Use of generative AI in this project overall: <strong>very limited</strong></p>
        <p>
            ChatGPT is used to <strong>discuss different approaches to solving problems</strong>, but no generated code is copy-pasted.
        </p>
    </dialog>
</footer>