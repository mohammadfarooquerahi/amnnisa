/**
 * Amnnisa Platform - Core Interactions & Routing
 */

document.addEventListener('DOMContentLoaded', function () {
  // Preloader Dismissal (Seamless splash screen on slow connections)
  function dismissPreloader() {
    const preloader = document.getElementById("amannisa-preloader");
    if (preloader && !preloader.classList.contains("loaded")) {
      preloader.classList.add("loaded");
      setTimeout(function () {
        if (preloader && preloader.parentNode) {
          preloader.parentNode.removeChild(preloader);
        }
      }, 450);
    }
  }

  if (document.readyState === "complete") {
    dismissPreloader();
  } else {
    window.addEventListener("load", dismissPreloader);
    setTimeout(dismissPreloader, 1800);
  }

  const MAIL = (window.amannisaData && window.amannisaData.mailTo) ? window.amannisaData.mailTo : "amnnisafoundation@gmail.com";
  const nav = document.getElementById("nav");
  const menuToggle = document.getElementById("menu-toggle");

  // Route Handling based on URL Hash
  function route() {
    const rawHash = location.hash.slice(1) || "home";
    const [page, subtab] = rawHash.split(":");
    
    // Determine target page
    let activePage = "home";
    let scrollToTarget = null;

    if (["home", "about", "team", "collaborators", "legal", "involved", "contact"].includes(page)) {
      if (page === "legal") {
        activePage = "collaborators";
      } else {
        activePage = page;
      }
    } else if (page === "report") {
      activePage = "involved";
    } else if (page === "legal-team" || page === "team-members" || page === "collaborators-section") {
      activePage = "collaborators";
      scrollToTarget = page;
    }

    // Toggle active section
    document.querySelectorAll(".pg").forEach(function (el) {
      el.classList.toggle("on", el.id === "p-" + activePage);
    });

    // Update main navigation active state
    document.querySelectorAll("nav.main-nav a").forEach(function (link) {
      const href = link.getAttribute("href");
      const isMatch = href === "#" + activePage ||
                      (activePage === "collaborators" && (href === "#collaborators" || href === "#legal"));
      link.classList.toggle("on", isMatch);
    });

    // If on involved page, activate tab
    if (activePage === "involved") {
      const targetTab = page === "report" ? "case" : (subtab || "idea");
      switchTab(targetTab);
    }

    // Close mobile menu on route change
    if (nav && nav.classList.contains("open")) {
      nav.classList.remove("open");
      if (menuToggle) {
        menuToggle.setAttribute("aria-expanded", "false");
        menuToggle.innerHTML = "☰";
      }
    }

    // Scroll to target element if specified, otherwise to top
    if (scrollToTarget) {
      setTimeout(function () {
        const targetEl = document.getElementById(scrollToTarget);
        if (targetEl) {
          targetEl.scrollIntoView({ behavior: "smooth", block: "start" });
        }
      }, 60);
    } else {
      window.scrollTo({ top: 0, behavior: "smooth" });
    }
  }

  // Tab Switcher for Get Involved
  function switchTab(tabId) {
    document.querySelectorAll(".tab").forEach(function (tabEl) {
      tabEl.classList.toggle("on", tabEl.dataset.t === tabId);
    });

    document.querySelectorAll("[data-p]").forEach(function (panelEl) {
      panelEl.classList.toggle("hide", panelEl.dataset.p !== tabId);
    });
  }

  // Bind tab click events
  document.querySelectorAll(".tab").forEach(function (tabEl) {
    tabEl.addEventListener("click", function () {
      const tabName = tabEl.dataset.t;
      location.hash = "involved:" + tabName;
    });
  });

  // Mobile menu toggle
  if (menuToggle && nav) {
    menuToggle.addEventListener("click", function (e) {
      e.stopPropagation();
      const isOpen = nav.classList.toggle("open");
      menuToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
      menuToggle.innerHTML = isOpen ? "✕" : "☰";
    });

    // Close when clicking outside
    document.addEventListener("click", function (e) {
      if (nav.classList.contains("open") && !nav.contains(e.target) && e.target !== menuToggle) {
        nav.classList.remove("open");
        menuToggle.setAttribute("aria-expanded", "false");
        menuToggle.innerHTML = "☰";
      }
    });

    // Close on Escape key
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && nav.classList.contains("open")) {
        nav.classList.remove("open");
        menuToggle.setAttribute("aria-expanded", "false");
        menuToggle.innerHTML = "☰";
      }
    });
  }

  // Close mobile nav when clicking any nav link
  document.querySelectorAll("nav.main-nav a").forEach(function (link) {
    link.addEventListener("click", function () {
      if (nav && nav.classList.contains("open")) {
        nav.classList.remove("open");
        if (menuToggle) {
          menuToggle.setAttribute("aria-expanded", "false");
          menuToggle.innerHTML = "☰";
        }
      }
    });
  });

  // Real Form Submission via WordPress AJAX + Email to Admin
  document.querySelectorAll("form").forEach(function (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      
      const submitBtn = form.querySelector('button[type="submit"], .btn.full');
      const originalText = submitBtn ? submitBtn.innerHTML : "Submit";
      const isAnon = form.querySelector("[name=_anon]")?.checked;
      const formType = form.dataset.sub || "Contact Inquiry";

      // Clear previous status alerts if any
      const existingStatus = form.parentNode.querySelector(".form-status");
      if (existingStatus) {
        existingStatus.remove();
      }

      // Check if WordPress AJAX backend is available
      if (window.amannisaData && window.amannisaData.ajaxUrl) {
        if (submitBtn) {
          submitBtn.innerHTML = "🛡 Submitting securely...";
          submitBtn.disabled = true;
        }

        const formData = new FormData(form);
        formData.append("action", "amannisa_submit_form");
        formData.append("security", window.amannisaData.nonce);
        formData.append("form_type", formType);
        if (isAnon) {
          formData.set("_anon", "true");
        }

        fetch(window.amannisaData.ajaxUrl, {
          method: "POST",
          body: formData,
        })
          .then(function (response) {
            return response.json();
          })
          .then(function (res) {
            if (submitBtn) {
              submitBtn.innerHTML = originalText;
              submitBtn.disabled = false;
            }

            const statusEl = document.createElement("div");
            if (res.success) {
              statusEl.className = "form-status success";
              statusEl.innerHTML = "<b>✓ Submitted Securely &amp; Emailed to Admin</b>" + res.data.message;
              form.reset();
            } else {
              statusEl.className = "form-status error";
              statusEl.innerHTML = "<b>✕ Submission Failed</b>" + (res.data?.message || "Please check your input and try again.");
            }
            form.parentNode.insertBefore(statusEl, form);
          })
          .catch(function (err) {
            if (submitBtn) {
              submitBtn.innerHTML = originalText;
              submitBtn.disabled = false;
            }
            const statusEl = document.createElement("div");
            statusEl.className = "form-status error";
            statusEl.innerHTML = "<b>✕ Network Error</b>Unable to connect to server. Please try again or email us directly at " + MAIL;
            form.parentNode.insertBefore(statusEl, form);
          });
      } else {
        // Fallback for static HTML previews without WordPress backend
        const formData = new FormData(form);
        const lines = [];

        formData.forEach(function (value, key) {
          if (key === "_anon" || !value.trim()) return;
          if (isAnon && /^(name|contact|phone|email)$/i.test(key)) return;
          lines.push(key + ": " + value.trim());
        });

        if (isAnon) {
          lines.unshift("[Submitted Anonymously - Identity Protected]");
        }

        const subject = form.dataset.sub || "Amnnisa Platform Submission";
        const body = encodeURIComponent(lines.join("\n\n"));
        const mailtoUrl = "mailto:" + MAIL + "?subject=" + encodeURIComponent(subject) + "&body=" + body;

        if (submitBtn) {
          submitBtn.innerHTML = "✓ Opening secure email client...";
          submitBtn.disabled = true;
        }

        setTimeout(function () {
          window.location.href = mailtoUrl;
          if (submitBtn) {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
          }
        }, 400);
      }
    });
  });

  // Listen to hash changes
  window.addEventListener("hashchange", route);

  // Initialize router
  route();
});
