// site-header.js — AUI Platform (2025 optimized build)
(function () {
    if (!document || !document.head) return;
    const head = document.head;

    /** 🧹 Eski favicon ve meta etiketlerini temizle **/
    head.querySelectorAll(`
        link[rel="icon"],
        link[rel="shortcut icon"],
        link[rel="apple-touch-icon"]
    `).forEach(el => el.remove());

    /** 🪞 Yeni favicon bağlantılarını ekle **/
    function addLink(rel, href, type) {
        const link = document.createElement("link");
        link.rel = rel;
        link.href = href;
        if (type) link.type = type;
        head.appendChild(link);
    }

    addLink("icon", "/favicon.png", "image/png");
    addLink("shortcut icon", "/favicon.ico", "image/x-icon");
    addLink("apple-touch-icon", "/favicon.png", "image/png");

    /** 🧠 Güvenli meta etiketi oluşturucu **/
    function ensureMeta(name, content) {
        let meta = head.querySelector(`meta[name="${name}"]`);
        if (!meta) {
            meta = document.createElement("meta");
            meta.name = name;
            head.appendChild(meta);
        }
        meta.content = content;
    }

    /** 🎨 Tema algılama (sistem temasıyla uyumlu) **/
    const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
    const themeColor = prefersDark ? "#0b1220" : "#ffffff";
    ensureMeta("theme-color", themeColor);

    /** 📱 Uygulama adı bilgisi **/
    ensureMeta("application-name", "AUI Platform");

    /** 🧩 Ek UX geliştirmeleri (isteğe bağlı) **/
    // Mobilde adres çubuğu rengi için dinamik güncelleme
    window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", e => {
        const newColor = e.matches ? "#0b1220" : "#ffffff";
        const themeMeta = head.querySelector('meta[name="theme-color"]');
        if (themeMeta) themeMeta.content = newColor;
    });

    /** ✅ Başarılı yükleme kaydı **/
    console.info("AUI site-header.js başarıyla yüklendi ve optimize edildi.");
})();
