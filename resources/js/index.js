import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import axios from "axios";
import ExampleHook from './components/ExampleHook'



axios.defaults.headers.post["Content-Type"] = "application/json";
axios.defaults.headers.put["Content-Type"] = "application/json";
axios.defaults.headers.patch["Content-Type"] = "application/json";
axios.defaults.headers.common["Authorization"] = localStorage.getItem("token");



class App extends Component {
  render () {
    return (
      <BrowserRouter>
        <div>
          <Switch>
              <Route exact path='/' component={ExampleHook} />
          </Switch>
        </div>
      </BrowserRouter>
    )
  }
}

ReactDOM.render(<App />, document.getElementById('app'))