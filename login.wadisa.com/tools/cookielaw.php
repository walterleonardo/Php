<!-- COOKIE LAW -->
<script type="text/javascript">
    $(document).ready(function() {
    var myCookie = document.cookie.replace(/(?:(?:^|.*;\s*)accepted\s*\=\s*([^;]*).*$)|^.*$/, "$1");
        if (myCookie != "yes") {
            $('#cookie-consent').show();
            $('#cookie-space').show();
            $('#accept').click(function() {
                document.cookie = "accepted=yes; expires=Thu, 18 Dec 2023 12:00:00 GMT; path=/";
                $('#cookie-space').hide();
                $('#cookie-consent').hide();
            });
        }
    });
</script>


<div id="cookie-space"></div>
<div id="cookie-consent">
    <div id="cookie-inner">
            <div id="cookie-text"><button id="accept">ACCEPT</button>
*  We have placed cookies onto your computer to help make this website better. Without them, this site would not function correctly or be able to collect information to make your experience better. By continuing to use this site, we'll assume you're OK with this.<br><br>
<a href="http://wificounter.wadisa.com/es/avisolegal.php" alt="BUHONET LEGAL">More Information</a><br>
            </div>
    </div>
 </div>
