function bindEvents() {
  const nav = document.querySelector(".nav");
  const menuButton = document.querySelector(".menu-button");
  const contactForm = document.querySelector(".contact-form");
  const navLinks = document.querySelectorAll(".nav-links a");

  function setActiveNavLink(activeLink) {
    navLinks.forEach((link) => {
      link.classList.toggle("active", link === activeLink);
      link.toggleAttribute("aria-current", link === activeLink);
    });
  }

  const currentHash = window.location.hash || "#home";
  const initialLink = document.querySelector(`.nav-links a[href="${currentHash}"]`);
  setActiveNavLink(initialLink || navLinks[0]);

  menuButton.addEventListener("click", () => {
    nav.classList.toggle("is-open");
  });

  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      setActiveNavLink(link);
      nav.classList.remove("is-open");
    });
  });

  contactForm.addEventListener("submit", async (event) => {
    event.preventDefault();

    const submitButton = contactForm.querySelector("button[type='submit']");
    const originalText = submitButton.textContent;

    submitButton.disabled = true;
    submitButton.textContent = "Sending...";

    try {
      const response = await fetch("api/contact.php", {
        method: "POST",
        body: new FormData(contactForm),
      });

      if (!response.ok) {
        throw new Error("Cannot send message");
      }

      contactForm.reset();
      alert("Message sent successfully.");
    } catch (error) {
      alert("Cannot send message. Please check MySQL and try again.");
    } finally {
      submitButton.disabled = false;
      submitButton.textContent = originalText;
    }
  });
}

function init() {
  bindEvents();
}

init();
