async function loadPartials() {
  const includeElements = document.querySelectorAll("[data-include]");

  await Promise.all(
    Array.from(includeElements).map(async (element) => {
      const response = await fetch(element.dataset.include);

      if (!response.ok) {
        throw new Error(`Cannot load ${element.dataset.include}`);
      }

      element.outerHTML = await response.text();
    })
  );
}

function createServiceCard(service, index) {
  const card = document.createElement("article");
  card.className = "service-card";
  card.innerHTML = `
    <div class="service-icon">${index + 1}</div>
    <h3>${service.title}</h3>
    <p>${service.description}</p>
  `;
  return card;
}

function createPropertyCard(property) {
  const card = document.createElement("article");
  card.className = "property-card";
  card.innerHTML = `
    <div class="image-placeholder property-image"></div>
    <div class="property-body">
      <div class="meta">
        <span>${property.type}</span>
        <span>${property.area}</span>
      </div>
      <h3>${property.title}</h3>
      <p>${property.address}</p>
      <span class="price">${property.price}</span>
    </div>
  `;
  return card;
}

function createBlogCard(blog) {
  const card = document.createElement("article");
  card.className = "blog-card";
  card.innerHTML = `
    <div class="image-placeholder blog-image"></div>
    <div class="blog-body">
      <div class="meta">
        <span>${blog.date}</span>
        <span>${blog.category}</span>
      </div>
      <h3>${blog.title}</h3>
      <p>${blog.description}</p>
    </div>
  `;
  return card;
}

async function loadData() {
  const servicesList = document.querySelector("#services-list");
  const propertiesList = document.querySelector("#properties-list");
  const blogsList = document.querySelector("#blogs-list");

  let response = await fetch("api/data.php");

  if (!response.ok) {
    response = await fetch("data/data.json");
  }

  const data = await response.json();

  servicesList.replaceChildren(...data.services.map(createServiceCard));
  propertiesList.replaceChildren(...data.properties.map(createPropertyCard));
  blogsList.replaceChildren(...data.blogs.map(createBlogCard));
}

function bindEvents() {
  const nav = document.querySelector(".nav");
  const menuButton = document.querySelector(".menu-button");
  const contactForm = document.querySelector(".contact-form");

  menuButton.addEventListener("click", () => {
    nav.classList.toggle("is-open");
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

async function init() {
  await loadPartials();
  bindEvents();
  await loadData();
}

init().catch((error) => {
  console.error("Unable to initialize page:", error);
});
