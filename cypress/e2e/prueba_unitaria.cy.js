describe('Prueba Unitaria', () => {
  it('Mostrar Pagina y Login', () => {

    // Corrige eventos no detectados por Cypress:
    cy.on("uncaught:exception", (e, runnable) => {
      console.log("error", e);
      console.log("runnable", runnable);
      return false;
      });

    cy.visit('http://localhost:8080/proyecto_sergio/');
    cy.get(':nth-child(1) > input').click();
    cy.get(':nth-child(1) > input').type('padmin');
    cy.get(':nth-child(3) > input').click();
    cy.get(':nth-child(3) > input').type('admin');
    cy.get('#login-box > button').click();
  })
})

