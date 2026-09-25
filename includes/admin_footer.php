        </main>


        <footer class="admin-footer">

            © <?= date('Y'); ?> BuildStore ERP
            — Sistem Manajemen Toko Bangunan

        </footer>

    </div>

</div>


<script>

const sidebarToggle =
    document.getElementById("sidebarToggle");

const sidebar =
    document.getElementById("adminSidebar");

if (sidebarToggle && sidebar) {

    sidebarToggle.addEventListener(
        "click",
        function () {

            sidebar.classList.toggle("show");

        }
    );

}

</script>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>