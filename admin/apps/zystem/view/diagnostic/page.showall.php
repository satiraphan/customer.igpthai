<div class="container my-5 bg-white shadow py-2 rounded">
    <h1>h1. Bootstrap heading</h1>
    <h2>h2. Bootstrap heading</h2>
    <h3>h3. Bootstrap heading</h3>
    <h4>h4. Bootstrap heading</h4>
    <h5>h5. Bootstrap heading</h5>
    <h6>h6. Bootstrap heading</h6>
    <h3>
      Fancy display heading
      <small class="text-muted">With faded secondary text</small>
    </h3>
    <h1 class="display-1">Display 1</h1>
    <h1 class="display-2">Display 2</h1>
    <h1 class="display-3">Display 3</h1>
    <h1 class="display-4">Display 4</h1>
    <h1 class="display-5">Display 5</h1>
    <h1 class="display-6">Display 6</h1>
    <p class="lead">
      This is a lead paragraph. It stands out from regular paragraphs.
    </p>
    <p>You can use the mark tag to <mark>highlight</mark> text.</p>
    <p><del>This line of text is meant to be treated as deleted text.</del></p>
    <p><s>This line of text is meant to be treated as no longer accurate.</s></p>
    <p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>
    <p><u>This line of text will render as underlined.</u></p>
    <p><small>This line of text is meant to be treated as fine print.</small></p>
    <p><strong>This line rendered as bold text.</strong></p>
    <p><em>This line rendered as italicized text.</em></p>
    <p><abbr title="attribute">attr</abbr></p>
    <p><abbr title="HyperText Markup Language" class="initialism">HTML</abbr></p>
    <figure>
      <blockquote class="blockquote">
        <p>A well-known quote, contained in a blockquote element.</p>
      </blockquote>
      <figcaption class="blockquote-footer">
        Someone famous in <cite title="Source Title">Source Title</cite>
      </figcaption>
    </figure>
    <ul class="list-unstyled">
      <li>This is a list.</li>
      <li>It appears completely unstyled.</li>
      <li>Structurally, it's still a list.</li>
      <li>However, this style only applies to immediate child elements.</li>
      <li>Nested lists:
        <ul>
          <li>are unaffected by this style</li>
          <li>will still show a bullet</li>
          <li>and have appropriate left margin</li>
        </ul>
      </li>
      <li>This may still come in handy in some situations.</li>
    </ul>
    <ul class="list-inline">
      <li class="list-inline-item">This is a list item.</li>
      <li class="list-inline-item">And another one.</li>
      <li class="list-inline-item">But they're displayed inline.</li>
    </ul>
    <dl class="row">
      <dt class="col-sm-3">Description lists</dt>
      <dd class="col-sm-9">A description list is perfect for defining terms.</dd>

      <dt class="col-sm-3">Term</dt>
      <dd class="col-sm-9">
        <p>Definition for the term.</p>
        <p>And some more placeholder definition text.</p>
      </dd>

      <dt class="col-sm-3">Another term</dt>
      <dd class="col-sm-9">This definition is short, so no extra paragraphs or anything.</dd>

      <dt class="col-sm-3 text-truncate">Truncated term is truncated</dt>
      <dd class="col-sm-9">This can be useful when space is tight. Adds an ellipsis at the end.</dd>

      <dt class="col-sm-3">Nesting</dt>
      <dd class="col-sm-9">
        <dl class="row">
          <dt class="col-sm-4">Nested definition list</dt>
          <dd class="col-sm-8">I heard you like definition lists. Let me put a definition list inside your definition list.</dd>
        </dl>
      </dd>
    </dl>
    <h1>How to make a website</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt, delectus!</p>
    <p>Lorem ipsum dolor, sit amet consectetur <a href="#">http://google.com</a> adipisicing elit. Voluptatum dolorem nam earum, unde atque quas in! Asperiores doloremque iure quam illo omnis iusto! Corporis voluptates temporibus obcaecati, expedita suscipit nihil.</p>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td colspan="2">Larry the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td colspan="2">Larry the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>
    <dl>
      <dt>Description lists</dt>
      <dd>A description list is perfect for defining terms.</dd>
      <dt>Term</dt>
      <dd>Definition for the term.</dd>
      <dd>A second definition for the same term.</dd>
      <dt>Another term</dt>
      <dd>Definition for this other term.</dd>
    </dl>
    <p>
      For example, <code>&lt;section&gt;</code> should be wrapped as inline.
    </p>
    <pre><code class="language-js">module.exports = {
  purge: [],
  theme: {
    extend: {},
  },
  variants: {},
  plugins: [],
}</code></pre>
    <pre><code>&lt;p&gt;Sample text here...&lt;/p&gt;
&lt;p&gt;And another line of sample text here...&lt;/p&gt;</code></pre>
    <var>y</var> = <var>m</var><var>x</var> + <var>b</var>
    <p>
      To switch directories, type <kbd>cd</kbd> followed by the name of the directory.<br>
      To edit settings, press <kbd><kbd>ctrl</kbd> + <kbd>,</kbd></kbd>
    </p>
    <samp>This text is meant to be treated as sample output from a computer program.</samp>
    <form>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="user@example.com">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
    </form>
    <form>
      <fieldset disabled>
        <legend>Disabled fieldset example</legend>
        <div class="mb-3">
          <label for="disabledTextInput" class="form-label">Disabled input</label>
          <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
        </div>
        <div class="mb-3">
          <label for="disabledSelect" class="form-label">Disabled select menu</label>
          <select id="disabledSelect" class="form-select">
            <option>Disabled select</option>
          </select>
        </div>
        <div class="mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" disabled>
            <label class="form-check-label" for="disabledFieldsetCheck">
              Can't check this
            </label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </fieldset>
    </form>
    <div class="vstack gap-2 my-2">
      <input class="form-control form-control-lg" type="text" placeholder="Large input" aria-label=".form-control-lg example">
      <input class="form-control" type="text" placeholder="Default input" aria-label="default input example">
      <input class="form-control form-control-sm" type="text" placeholder="Small input" aria-label=".form-control-sm example">
    </div>
    <div class="mb-3">
      <label for="formFile" class="form-label">Default file input example</label>
      <input class="form-control" type="file" id="formFile">
    </div>
    <div class="mb-3">
      <label for="formFileMultiple" class="form-label">Multiple files input example</label>
      <input class="form-control" type="file" id="formFileMultiple" multiple>
    </div>
    <div class="mb-3">
      <label for="formFileDisabled" class="form-label">Disabled file input example</label>
      <input class="form-control" type="file" id="formFileDisabled" disabled>
    </div>
    <div class="mb-3">
      <label for="formFileSm" class="form-label">Small file input example</label>
      <input class="form-control form-control-sm" id="formFileSm" type="file">
    </div>
    <div>
      <label for="formFileLg" class="form-label">Large file input example</label>
      <input class="form-control form-control-lg" id="formFileLg" type="file">
    </div>
    <label for="exampleColorInput" class="form-label">Color picker</label>
    <input type="color" class="form-control form-control-color" id="exampleColorInput" value="#563d7c" title="Choose your color">
    <select class="form-select form-select-lg my-1" aria-label=".form-select-lg example">
      <option selected>Open this select menu</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    <select class="form-select my-1" aria-label="Default select example">
      <option selected>Open this select menu</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    <select class="form-select form-select-sm my-1" aria-label=".form-select-sm example">
      <option selected>Open this select menu</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    <div class="form-check my-4">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Default checkbox
      </label>
    </div>
    <div class="form-check my-2">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled>
      <label class="form-check-label" for="flexCheckDisabled">
        Disabled checkbox
      </label>
    </div>
    <div class="form-check my-2">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
      <label class="form-check-label" for="flexCheckCheckedDisabled">
        Disabled checked checkbox
      </label>
    </div>
    <div class="form-check my-2">
      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
      <label class="form-check-label" for="flexRadioDefault1">
        Default radio
      </label>
    </div>
    <div class="form-check my-2">
      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
      <label class="form-check-label" for="flexRadioDefault2">
        Default checked radio
      </label>
    </div>
    <div class="form-check my-2">
      <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled>
      <label class="form-check-label" for="flexRadioDisabled">
        Disabled radio
      </label>
    </div>
    <div class="form-check my-2">
      <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" checked disabled>
      <label class="form-check-label" for="flexRadioCheckedDisabled">
        Disabled checked radio
      </label>
    </div>
    <div class="form-check form-switch my-2">
      <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
      <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
    </div>
    <div class="form-check form-switch my-2">
      <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
      <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
    </div>
    <div class="form-check form-switch my-2">
      <input class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled" disabled>
      <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch checkbox input</label>
    </div>
    <div class="form-check form-switch my-2">
      <input class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedDisabled" checked disabled>
      <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled checked switch checkbox input</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
      <label class="form-check-label" for="inlineCheckbox1">Check1</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
      <label class="form-check-label" for="inlineCheckbox2">Check2</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
      <label class="form-check-label" for="inlineCheckbox3">Check3 (disabled)</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
      <label class="form-check-label" for="inlineRadio1">Radio1</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
      <label class="form-check-label" for="inlineRadio2">Radio2</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
      <label class="form-check-label" for="inlineRadio3">Radio3 (disabled)</label>
    </div>
    <div>
      <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
    </div>
    <div>
      <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel1" value="" aria-label="...">
    </div>
    <label for="customRange1" class="form-label">Example range</label>
    <input type="range" class="form-range" id="customRange1">
    <label for="disabledRange" class="form-label">Disabled range</label>
    <input type="range" class="form-range" id="disabledRange" disabled>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">@</span>
      <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>

    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
      <span class="input-group-text" id="basic-addon2">@example.com</span>
    </div>

    <label for="basic-url" class="form-label">Your vanity URL</label>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
      <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text">$</span>
      <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
      <span class="input-group-text">.00</span>
    </div>

    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Username" aria-label="Username">
      <span class="input-group-text">@</span>
      <input type="text" class="form-control" placeholder="Server" aria-label="Server">
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text">With textarea</span>
      <textarea class="form-control" aria-label="With textarea"></textarea>
    </div>
    <div class="input-group input-group-sm mb-3">
      <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
      <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text" id="inputGroup-sizing-default">Default</span>
      <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group input-group-lg mb-3">
      <span class="input-group-text" id="inputGroup-sizing-lg">Large</span>
      <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
    </div>
    <div class="input-group mb-3">
      <div class="input-group-text">
        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
      </div>
      <input type="text" class="form-control" aria-label="Text input with checkbox">
    </div>

    <div class="input-group mb-3">
      <div class="input-group-text">
        <input class="form-check-input mt-0" type="radio" value="" aria-label="Radio button for following text input">
      </div>
      <input type="text" class="form-control" aria-label="Text input with radio button">
    </div>
    <div class="input-group mb-3">
      <button class="btn btn-light" type="button" id="button-addon1">Button</button>
      <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
    </div>

    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
      <button class="btn btn-light" type="button" id="button-addon2">Button</button>
    </div>

    <div class="input-group mb-3">
      <button class="btn btn-light" type="button">Button</button>
      <button class="btn btn-light" type="button">Button</button>
      <input type="text" class="form-control" placeholder="" aria-label="Example text with two button addons">
    </div>

    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username with two button addons">
      <button class="btn btn-light" type="button">Button</button>
      <button class="btn btn-light" type="button">Button</button>
    </div>
    <div class="input-group mb-3">
      <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#">Separated link</a></li>
      </ul>
      <input type="text" class="form-control" aria-label="Text input with dropdown button">
    </div>

    <div class="input-group mb-3">
      <input type="text" class="form-control" aria-label="Text input with dropdown button">
      <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#">Separated link</a></li>
      </ul>
    </div>

    <div class="input-group mb-3">
      <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Action before</a></li>
        <li><a class="dropdown-item" href="#">Another action before</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#">Separated link</a></li>
      </ul>
      <input type="text" class="form-control" aria-label="Text input with 2 dropdown buttons">
      <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#">Separated link</a></li>
      </ul>
    </div>
    <div class="form-floating mb-3">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating mb-3">
      <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
        <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
      <label for="floatingSelect">Works with selects</label>
    </div>
    <form class="row g-3 mb-3">
      <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail4">
      </div>
      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword4">
      </div>
      <div class="col-12">
        <label for="inputAddress" class="form-label">Address</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
      </div>
      <div class="col-12">
        <label for="inputAddress2" class="form-label">Address 2</label>
        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
      </div>
      <div class="col-md-6">
        <label for="inputCity" class="form-label">City</label>
        <input type="text" class="form-control" id="inputCity">
      </div>
      <div class="col-md-4">
        <label for="inputState" class="form-label">State</label>
        <select id="inputState" class="form-select">
          <option selected>Choose...</option>
          <option>...</option>
        </select>
      </div>
      <div class="col-md-2">
        <label for="inputZip" class="form-label">Zip</label>
        <input type="text" class="form-control" id="inputZip">
      </div>
      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck">
          <label class="form-check-label" for="gridCheck">
            Check me out
          </label>
        </div>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Sign in</button>
      </div>
    </form>
    <form class="row g-3 mb-3">
      <div class="col-md-4">
        <label for="validationServer01" class="form-label">First name</label>
        <input type="text" class="form-control is-valid" id="validationServer01" value="Mark" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col-md-4">
        <label for="validationServer02" class="form-label">Last name</label>
        <input type="text" class="form-control is-valid" id="validationServer02" value="Otto" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col-md-4">
        <label for="validationServerUsername" class="form-label">Username</label>
        <div class="input-group has-validation">
          <span class="input-group-text" id="inputGroupPrepend3">@</span>
          <input type="text" class="form-control is-invalid" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
          <div id="validationServerUsernameFeedback" class="invalid-feedback">
            Please choose a username.
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <label for="validationServer03" class="form-label">City</label>
        <input type="text" class="form-control is-invalid" id="validationServer03" aria-describedby="validationServer03Feedback" required>
        <div id="validationServer03Feedback" class="invalid-feedback">
          Please provide a valid city.
        </div>
      </div>
      <div class="col-md-3">
        <label for="validationServer04" class="form-label">State</label>
        <select class="form-select is-invalid" id="validationServer04" aria-describedby="validationServer04Feedback" required>
          <option selected disabled value="">Choose...</option>
          <option>...</option>
        </select>
        <div id="validationServer04Feedback" class="invalid-feedback">
          Please select a valid state.
        </div>
      </div>
      <div class="col-md-3">
        <label for="validationServer05" class="form-label">Zip</label>
        <input type="text" class="form-control is-invalid" id="validationServer05" aria-describedby="validationServer05Feedback" required>
        <div id="validationServer05Feedback" class="invalid-feedback">
          Please provide a valid zip.
        </div>
      </div>
      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" aria-describedby="invalidCheck3Feedback" required>
          <label class="form-check-label" for="invalidCheck3">
            Agree to terms and conditions
          </label>
          <div id="invalidCheck3Feedback" class="invalid-feedback">
            You must agree before submitting.
          </div>
        </div>
      </div>
      <div class="col-12">
        <button class="btn btn-primary" type="submit">Submit form</button>
      </div>
    </form>
    <div class="mb-3" style="max-width:600px">
      <div class="accordion" id="accordionExample">
        <div class="accordion-item active">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Accordion Item #1
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Accordion Item #2
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Accordion Item #3
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Holy guacamole!</strong> You should check in on some of those fields below.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="alert alert-primary" role="alert">
      A simple primary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
    </div>
    <div class="alert alert-secondary" role="alert">
      A simple secondary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
    </div>
    <div class="alert alert-success" role="alert">
      A simple success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
    </div>
    <div class="alert alert-danger" role="alert">
      A simple danger alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
    </div>
    <div class="alert alert-warning" role="alert">
      A simple warning alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
    </div>
    <div class="alert alert-info" role="alert">
      A simple info alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
    </div>
    <div class="alert alert-light" role="alert">
      A simple light alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
    </div>
    <div class="alert alert-dark" role="alert">
      A simple dark alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
    </div>
    <h1>Example heading <span class="badge bg-secondary">New</span></h1>
    <h2>Example heading <span class="badge bg-secondary">New</span></h2>
    <h3>Example heading <span class="badge bg-secondary">New</span></h3>
    <h4>Example heading <span class="badge bg-secondary">New</span></h4>
    <h5>Example heading <span class="badge bg-secondary">New</span></h5>
    <h6>Example heading <span class="badge bg-secondary">New</span></h6>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
      </ol>
    </nav>

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Library</li>
      </ol>
    </nav>

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Library</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data</li>
      </ol>
    </nav>
    <div class="d-flex gap-3 my-3">
      <button type="button" class="btn btn-sm btn-primary">Primary</button>
      <button type="button" class="btn btn-sm btn-secondary">Secondary</button>
      <button type="button" class="btn btn-sm btn-success">Success</button>
      <button type="button" class="btn btn-sm btn-danger">Danger</button>
      <button type="button" class="btn btn-sm btn-warning">Warning</button>
      <button type="button" class="btn btn-sm btn-info">Info</button>
      <button type="button" class="btn btn-sm btn-light">Light</button>
      <button type="button" class="btn btn-sm btn-dark">Dark</button>
      <button type="button" class="btn btn-sm btn-link">Link</button>
    </div>
    <div class="d-flex gap-3 my-3">
      <button type="button" disabled class="btn btn-sm btn-primary">Primary</button>
      <button type="button" disabled class="btn btn-sm btn-secondary">Secondary</button>
      <button type="button" disabled class="btn btn-sm btn-success">Success</button>
      <button type="button" disabled class="btn btn-sm btn-danger">Danger</button>
      <button type="button" disabled class="btn btn-sm btn-warning">Warning</button>
      <button type="button" disabled class="btn btn-sm btn-info">Info</button>
      <button type="button" disabled class="btn btn-sm btn-light">Light</button>
      <button type="button" disabled class="btn btn-sm btn-dark">Dark</button>
      <button type="button" disabled class="btn btn-sm btn-link">Link</button>
    </div>
    <div class="d-flex gap-3 my-3">
      <button type="button" class="btn btn-primary">Primary</button>
      <button type="button" class="btn btn-secondary">Secondary</button>
      <button type="button" class="btn btn-success">Success</button>
      <button type="button" class="btn btn-danger">Danger</button>
      <button type="button" class="btn btn-warning">Warning</button>
      <button type="button" class="btn btn-info">Info</button>
      <button type="button" class="btn btn-light">Light</button>
      <button type="button" class="btn btn-dark">Dark</button>
      <button type="button" class="btn btn-link">Link</button>
    </div>
    <div class="d-flex gap-3 my-3">
      <button type="button" disabled class="btn btn-primary">Primary</button>
      <button type="button" disabled class="btn btn-secondary">Secondary</button>
      <button type="button" disabled class="btn btn-success">Success</button>
      <button type="button" disabled class="btn btn-danger">Danger</button>
      <button type="button" disabled class="btn btn-warning">Warning</button>
      <button type="button" disabled class="btn btn-info">Info</button>
      <button type="button" disabled class="btn btn-light">Light</button>
      <button type="button" disabled class="btn btn-dark">Dark</button>
      <button type="button" disabled class="btn btn-link">Link</button>
    </div>
    <div class="d-flex gap-3 my-3">
      <button type="button" class="btn btn-lg btn-primary">Primary</button>
      <button type="button" class="btn btn-lg btn-secondary">Secondary</button>
      <button type="button" class="btn btn-lg btn-success">Success</button>
      <button type="button" class="btn btn-lg btn-danger">Danger</button>
      <button type="button" class="btn btn-lg btn-warning">Warning</button>
      <button type="button" class="btn btn-lg btn-info">Info</button>
      <button type="button" class="btn btn-lg btn-light">Light</button>
      <button type="button" class="btn btn-lg btn-dark">Dark</button>
      <button type="button" class="btn btn-lg btn-link">Link</button>
    </div>
    <div class="d-flex gap-3 my-3">
      <button type="button" disabled class="btn btn-lg btn-primary">Primary</button>
      <button type="button" disabled class="btn btn-lg btn-secondary">Secondary</button>
      <button type="button" disabled class="btn btn-lg btn-success">Success</button>
      <button type="button" disabled class="btn btn-lg btn-danger">Danger</button>
      <button type="button" disabled class="btn btn-lg btn-warning">Warning</button>
      <button type="button" disabled class="btn btn-lg btn-info">Info</button>
      <button type="button" disabled class="btn btn-lg btn-light">Light</button>
      <button type="button" disabled class="btn btn-lg btn-dark">Dark</button>
      <button type="button" disabled class="btn btn-lg btn-link">Link</button>
    </div>
    <div class="d-flex gap-3 my-3 align-items-center">
      <button type="button" class="btn btn-outline-primary">Primary</button>
      <button type="button" class="btn btn-outline-secondary">Secondary</button>
      <button type="button" class="btn btn-outline-success">Success</button>
      <button type="button" class="btn btn-outline-danger">Danger</button>
      <button type="button" class="btn btn-outline-warning">Warning</button>
      <button type="button" class="btn btn-outline-info">Info</button>
      <div class="px-4 py-2 bg-dark rounded">
        <button type="button" class="btn btn-outline-light">Light</button>
      </div>
      <button type="button" class="btn btn-outline-dark">Dark</button>
    </div>
    <div class="d-flex gap-3 my-3 align-items-center">
      <button type="button" disabled class="btn btn-outline-primary">Primary</button>
      <button type="button" disabled class="btn btn-outline-secondary">Secondary</button>
      <button type="button" disabled class="btn btn-outline-success">Success</button>
      <button type="button" disabled class="btn btn-outline-danger">Danger</button>
      <button type="button" disabled class="btn btn-outline-warning">Warning</button>
      <button type="button" disabled class="btn btn-outline-info">Info</button>
      <div class="px-4 py-2 bg-dark rounded">
        <button type="button" disabled class="btn btn-outline-light">Light</button>
      </div>
      <button type="button" disabled class="btn btn-outline-dark">Dark</button>
    </div>
    <div class="btn-group my-3" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-light">Left</button>
      <button type="button" class="btn btn-light">Middle</button>
      <button type="button" class="btn btn-light">Right</button>
    </div>
    <div class="card my-4" style="width: 18rem;">
      <img src="https://images.unsplash.com/photo-1551500226-b50b653e33e8?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
    <div class="dropdown mb-5">
      <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Dropdown button
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li>
          <h6 class="dropdown-header">Dropdown header</h6>
        </li>
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
        <li><a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Disabled link</a></li>
      </ul>
    </div>
    <ul class="list-group mb-3">
      <li class="list-group-item">An item</li>
      <li class="list-group-item">A second item</li>
      <li class="list-group-item">A third item</li>
      <li class="list-group-item disabled" aria-disabled="true">A disabled item</li>
      <li class="list-group-item">A fourth item</li>
      <li class="list-group-item">And a fifth one</li>
    </ul>
    <div class="list-group mb-3">
      <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
        The current link item
      </a>
      <a href="#" class="list-group-item list-group-item-action">A second link item</a>
      <a href="#" class="list-group-item list-group-item-action">A third link item</a>
      <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
      <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A disabled link item</a>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus quis eum ullam labore blanditiis obcaecati optio provident, repellat temporibus qui?</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptates recusandae vero, ducimus earum odit ipsam natus nesciunt quidem quae ex, explicabo vel exercitationem impedit molestias.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <ul class="nav my-4">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>

    <ul class="nav nav-tabs my-4">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>

    <ul class="nav nav-pills my-4">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>

    <ul class="nav nav-tabs my-4">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Active</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="#">Separated link</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow my-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Brand</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="javascript:void(0)">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Shop
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="javascript:void(0)">Men</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)">Women</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)">Kids</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)">Components</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-light" type="button">
              Search
            </button>
          </form>
        </div>
      </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow my-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Brand</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDark1" aria-controls="navbarDark1" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarDark1">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="javascript:void(0)">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Shop
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown2">
                <li><a class="dropdown-item" href="javascript:void(0)">Men</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)">Women</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)">Kids</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="border-0 form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="border-0 btn btn-light" type="button">
              Search
            </button>
          </form>
        </div>
      </div>
    </nav>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
      </li>
      <li class="nav-item dropdown" role="presentation">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">More</a>
        <ul class="dropdown-menu">
          <li><button class="dropdown-item" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false">About</button></li>
          <li><button class="dropdown-item" id="career-tab" data-bs-toggle="tab" data-bs-target="#career" type="button" role="tab" aria-controls="career" aria-selected="false">Career</button></li>
        </ul>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane p-4 fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <h4>This is home page</h4>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto voluptas maxime maiores ipsam! Laboriosam voluptates, necessitatibus quidem at laborum, expedita dolorem optio reprehenderit consequatur iste inventore velit aut repudiandae. Consequuntur vero libero pariatur eius ratione corrupti officiis, consequatur aliquid, doloribus voluptates necessitatibus nisi magni modi. Molestias, corrupti. Praesentium, ratione reiciendis.</p>
      </div>
      <div class="tab-pane p-4 fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <h4>This is profile page</h4>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto voluptas maxime maiores ipsam! Laboriosam voluptates, necessitatibus quidem at laborum, expedita dolorem optio reprehenderit consequatur iste inventore velit aut repudiandae. Consequuntur vero libero pariatur eius ratione corrupti officiis, consequatur aliquid, doloribus voluptates necessitatibus nisi magni modi. Molestias, corrupti. Praesentium, ratione reiciendis.</p>
      </div>
      <div class="tab-pane p-4 fade" id="about" role="tabpanel" aria-labelledby="about-tab">
        <h4>This is about page</h4>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto voluptas maxime maiores ipsam! Laboriosam voluptates, necessitatibus quidem at laborum, expedita dolorem optio reprehenderit consequatur iste inventore velit aut repudiandae. Consequuntur vero libero pariatur eius ratione corrupti officiis, consequatur aliquid, doloribus voluptates necessitatibus nisi magni modi. Molestias, corrupti. Praesentium, ratione reiciendis.</p>
      </div>
      <div class="tab-pane p-4 fade" id="career" role="tabpanel" aria-labelledby="career-tab">
        <h4>This is career page</h4>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto voluptas maxime maiores ipsam! Laboriosam voluptates, necessitatibus quidem at laborum, expedita dolorem optio reprehenderit consequatur iste inventore velit aut repudiandae. Consequuntur vero libero pariatur eius ratione corrupti officiis, consequatur aliquid, doloribus voluptates necessitatibus nisi magni modi. Molestias, corrupti. Praesentium, ratione reiciendis.</p>
      </div>
      <div class="tab-pane p-4 fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <h4>This is contact page</h4>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto voluptas maxime maiores ipsam! Laboriosam voluptates, necessitatibus quidem at laborum, expedita dolorem optio reprehenderit consequatur iste inventore velit aut repudiandae. Consequuntur vero libero pariatur eius ratione corrupti officiis, consequatur aliquid, doloribus voluptates necessitatibus nisi magni modi. Molestias, corrupti. Praesentium, ratione reiciendis.</p>
      </div>
    </div>

    <a class="btn btn-primary mb-3" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
      Link with href
    </a>
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      Button with data-bs-target
    </button>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div>
          Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
        </div>
        <div class="dropdown mt-3">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
            Dropdown button
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="d-flex align-items-center gap-1 my-3">
      <input type="text" class="form-control form-control-sm">
      <nav aria-label="Page navigation example">
        <ul class="pagination pagination-sm">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true" aria-label="Previous">
              Prev
            </a>
          </li>
          <li class="page-item active" aria-current="page">
            <a class="page-link" href="javascript:void(0)">1</a>
          </li>
          <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
          <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0)" aria-label="Next">
              Next
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <div class="d-flex align-items-center gap-1 my-3">
      <input type="text" class="form-control">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true" aria-label="Previous">
              Prev
            </a>
          </li>
          <li class="page-item active" aria-current="page">
            <a class="page-link" href="javascript:void(0)">1</a>
          </li>
          <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
          <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0)" aria-label="Next">
              Next
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <div class="d-flex align-items-center gap-1 my-3">
      <input type="text" class="form-control form-control-lg">
      <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true" aria-label="Previous">
              Prev
            </a>
          </li>
          <li class="page-item active" aria-current="page">
            <a class="page-link" href="javascript:void(0)">1</a>
          </li>
          <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
          <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0)" aria-label="Next">
              Next
            </a>
          </li>
        </ul>
      </nav>
    </div>

    <div class="d-flex gap-5 my-5">
      <div class="bg-white p-3 rounded shadow-sm">Small shadow</div>
      <div class="bg-white p-3 rounded shadow">Regular shadow</div>
      <div class="bg-white p-3 rounded shadow-lg">Larger shadow</div>
    </div>

    <div class="d-flex align-items-center gap-4 my-4">
      <button class="btn btn-light d-flex gap-2 btn-sm">
        <svg width="17" height="17" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        Search
      </button>
      <button class="btn btn-light d-flex gap-2">
        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        Search
      </button>
      <button class="btn btn-light d-flex gap-2 btn-lg">
        <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        Search
      </button>
    </div>

    <div class="d-flex align-items-center gap-4 my-4">
      <button class="btn btn-light d-flex gap-2 btn-sm">
        <svg width="17" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
        </svg>
        Menu
      </button>
      <button class="btn btn-light d-flex gap-2">
        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
        </svg>
        Menu
      </button>
      <button class="btn btn-light d-flex gap-2 btn-lg">
        <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
        </svg>
        Menu
      </button>
    </div>

    <p class="mb-0 text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, ex.</p>
    <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, ex.</p>
    <p class="mb-0 text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, ex.</p>
    <p class="mb-0 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, ex.</p>
    <p class="mb-0 text-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, ex.</p>
    <p class="mb-0 text-primary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, ex.</p>
    <p class="mb-0 text-success">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, ex.</p>
    <p class="mb-0 text-warning">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, ex.</p>
    <p class="mb-0 text-danger">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, ex.</p>
    <p class="mb-0 text-info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, ex.</p>
  </div>