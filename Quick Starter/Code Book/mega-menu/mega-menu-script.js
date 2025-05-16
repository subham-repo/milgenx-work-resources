let mgmenutriggers = document.querySelectorAll("ul.menu_main_nav > li.menu-item");
let mgmenus = document.querySelectorAll(".mgmenu-section");
let siteHeader = document.querySelector("header.top_panel section.elementor-top-section");

// Function to check if any mega menu is visible
function checkMegaMenuVisibility() {
    let isAnyMenuVisible = Array.from(mgmenus).some((mgmenu) =>
        mgmenu.classList.contains("show-it")
    );

    // Set overflow based on visibility
    document.querySelector("html").style.overflow = isAnyMenuVisible ? "hidden" : "";
}

// Add mouseover event for showing mega menu
mgmenutriggers.forEach(function (mgmenutrigger) {
    mgmenutrigger.addEventListener("mouseover", function () {
        let siteHeaderHeight = siteHeader.clientHeight;
        let mgmenutriggerHandle = (mgmenutrigger.querySelector("span"))
            ? mgmenutrigger.querySelector("span").innerText.toLowerCase().replace(/\s+/g, '-')
            : '';

        // Hide all other mega menus first
        mgmenus.forEach(function (mgmenu) {
            mgmenu.classList.remove("show-it");
        });

        // Show the current mega menu
        mgmenus.forEach(function (mgmenu) {
            let mgmenuHandle = mgmenu.getAttribute("mgmenu-target");
            if (window.screen.width > 1024) {
                mgmenu.style.top = siteHeaderHeight + "px";
                if (mgmenuHandle === mgmenutriggerHandle) {
                    mgmenu.classList.add("show-it");
                }
            }
        });

        // Check if any menu is visible to handle overflow
        checkMegaMenuVisibility();
    });
});

// Add mouseleave event to hide the mega menu only when the cursor leaves both header and mega menu
document.addEventListener("mouseover", function (e) {
    const isInsideHeaderOrMenu = siteHeader.contains(e.target) || Array.from(mgmenus).some((mgmenu) => mgmenu.contains(e.target));

    if (!isInsideHeaderOrMenu) {
        mgmenus.forEach(function (mgmenu) {
            mgmenu.classList.remove("show-it");
        });

        // Check if any menu is visible to handle overflow
        checkMegaMenuVisibility();
    }
});
