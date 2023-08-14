describe("prueba_componente", () => {
it("tests prueba_componente", () => {

  // Corrige eventos no detectados por Cypress:
  cy.on("uncaught:exception", (e, runnable) => {
    console.log("error", e);
    console.log("runnable", runnable);
    return false;
    });


  cy.viewport(771, 561);

  cy.visit("http://localhost:8080/proyecto_sergio/");

  cy.get("#login-box > div > div:nth-child(1) > input[type=text]").click();

  cy.get("#login-box > div > div:nth-child(1) > input[type=text]").type("padmin");

  cy.get("#login-box > div > div:nth-child(3) > input[type=password]").click();

  cy.get("#login-box > div > div:nth-child(3) > input[type=password]").type("admin");

  cy.get("#login-box > button").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/");

  cy.get("#menu > ul > li:nth-child(8) > a > span").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/listar_categorias.php");

  cy.get("#contenido > div > div.d-sm-flex.align-items-center.justify-content-between.mb-4 > a").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/registro_categorias.php");

  cy.get("#nombre").click();

  cy.get("#nombre").type("Frutas");

  cy.get("#contenido > div.row > div > form > input").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/registro_categorias.php");

  cy.get("#menu > ul > li:nth-child(10) > a > span").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/listar_productos.php");

  cy.get("#contenido > div > div.d-sm-flex.align-items-center.justify-content-between.mb-4 > a").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/registro_productos.php");

  cy.get("#codigobarras").click();

  cy.get("#codigobarras").type("7676");

  cy.get("#descripcion").click();

  cy.get("#descripcion").type("Manzana");

  cy.get("#precioventa").click();

  cy.get("#precioventa").type("1500");

  cy.get("#preciocosto").click();

  cy.get("#preciocosto").type("750");

  cy.get("#stock").click();

  cy.get("#stock").type("25");

  cy.get("#idcategoria").select('Frutas');

  cy.get("#idcategoria").type("4");

  cy.get("#idproveedor").select('Proveedor General');

  cy.get("#idproveedor").type("9");

  cy.get("#contenido > div.row > div > form > input").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/registro_productos.php");

  cy.get("#menu > ul > li:nth-child(10) > a > span").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/sistema/listar_productos.php");

  cy.get("#cabecera > div > div:nth-child(2) > div > button > a").click();
  cy.location("href").should("eq", "http://localhost:8080/proyecto_sergio/");

  });
});
//# recorderSourceMap=BCCECGCICKCMCODRDUDXCZCbDeDhBDkBCmBCoBCqBCsBCuBCwBCyBC0BC2BC4BC6BC8BC+BCgCDjCDmCD
