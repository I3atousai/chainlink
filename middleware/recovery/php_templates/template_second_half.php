<input required
                class="mb8"
                pattern="[a-z0-9]{8,}"
                type="password"
                name="password"
                placeholder="Пароль более 8 символов"
              />
            <button class="btn-1 fs24" name="submit">Подтвердить</button>
          </form>
          <?php
  if (isset($_GET['password_recovery_hash'])) {
    # code...
    $_SESSION['password_recovery_hash'] = $_GET['password_recovery_hash'];
  }
  if (isset($_POST["submit"])) {